<?php

namespace App\Http\Controllers;

use App\Models\GameLeaderboard;
use App\Models\GameMove;
use App\Models\GameRoom;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Lama waktu berpikir per pemain untuk mode online (dalam detik). 10 menit.
     */
    private const TIME_PER_PLAYER = 600;

    /**
     * Susunan papan awal Los Alamos Chess (6x6).
     * Baris index 0 = rank 6 (baris belakang HITAM), baris index 5 = rank 1 (baris belakang PUTIH).
     * Huruf besar = bidak putih, huruf kecil = bidak hitam. null = kotak kosong.
     *
     * Formasi baris belakang (sesuai aturan Los Alamos): R N Q K N R (tanpa Bishop/Gajah).
     */
    private function initialBoard(): array
    {
        return [
            ['r', 'n', 'q', 'k', 'n', 'r'],
            ['p', 'p', 'p', 'p', 'p', 'p'],
            [null, null, null, null, null, null],
            [null, null, null, null, null, null],
            ['P', 'P', 'P', 'P', 'P', 'P'],
            ['R', 'N', 'Q', 'K', 'N', 'R'],
        ];
    }

    /**
     * Query dasar leaderboard: join ke data_pelajar supaya dapat nama & foto,
     * diurutkan dari total_poin tertinggi, lalu jumlah menang sebagai tie-breaker.
     */
    private function leaderboardQuery()
    {
        return GameLeaderboard::query()
            ->leftJoin('data_pelajar', 'data_pelajar.no_id', '=', 'game_leaderboards.no_id')
            ->select(
                'game_leaderboards.no_id',
                'game_leaderboards.menang',
                'game_leaderboards.seri',
                'game_leaderboards.kalah',
                'game_leaderboards.total_poin',
                'data_pelajar.nama as nama_pelajar',
                'data_pelajar.foto as foto_pelajar'
            )
            ->orderByDesc('game_leaderboards.total_poin')
            ->orderByDesc('game_leaderboards.menang');
    }

    /**
     * 1) Menampilkan halaman utama game Catur 6x6 beserta leaderboard 10 besar.
     *    Halaman ini tetap bisa diakses tamu (belum login), tetapi mode online & leaderboard
     *    hanya benar-benar aktif jika session('no_id') tersedia.
     */
    public function index()
    {
        $noId = session('no_id');
        $isLoggedIn = !is_null($noId);

        $leaderboard = $this->leaderboardQuery()->limit(10)->get();

        return view('pages.catur', [
            'isLoggedIn' => $isLoggedIn,
            'noId' => $noId,
            'leaderboard' => $leaderboard,
        ]);
    }

    /**
     * Endpoint AJAX ringan untuk me-refresh leaderboard tanpa reload halaman penuh
     * (dipanggil JS setelah sebuah game online selesai).
     */
    public function leaderboardData(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->leaderboardQuery()->limit(10)->get(),
        ]);
    }

    /**
     * 2) Logika antrean matchmaking.
     *    - Jika user sudah dalam room 'playing', kembalikan room itu (misal refresh halaman).
     *    - Jika user sudah menunggu (waiting) sebelumnya, kembalikan room waiting miliknya.
     *    - Jika ada room lain yang sedang 'waiting' (bukan milik sendiri), gabung sebagai player2 -> mulai main.
     *    - Jika tidak ada, buat room baru berstatus 'waiting' sebagai player1.
     */
    public function findMatch(Request $request): JsonResponse
    {
        $noId = session('no_id');
        if (!$noId) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu untuk bermain mode online.',
            ], 401);
        }

        return DB::transaction(function () use ($noId) {
            // Cek apakah sudah punya pertandingan aktif
            $existingActive = GameRoom::where('status', 'playing')
                ->where(function ($q) use ($noId) {
                    $q->where('player1_id', $noId)->orWhere('player2_id', $noId);
                })
                ->first();

            if ($existingActive) {
                return response()->json([
                    'success' => true,
                    'status' => 'matched',
                    'room_id' => $existingActive->id,
                ]);
            }

            // Cek apakah user ini sendiri sedang menunggu (dari room yang dia buat sebelumnya)
            $ownWaiting = GameRoom::where('status', 'waiting')->where('player1_id', $noId)->first();
            if ($ownWaiting) {
                return response()->json([
                    'success' => true,
                    'status' => 'waiting',
                    'room_id' => $ownWaiting->id,
                ]);
            }

            // Cari room lain yang menunggu lawan. lockForUpdate() mencegah 2 user
            // ter-matching ke room yang sama secara bersamaan (race condition).
            $waitingRoom = GameRoom::where('status', 'waiting')
                ->where('player1_id', '!=', $noId)
                ->lockForUpdate()
                ->orderBy('created_at')
                ->first();

            if ($waitingRoom) {
                // Gabung sebagai pemain kedua (bidak HITAM), game langsung dimulai
                $waitingRoom->player2_id = $noId;
                $waitingRoom->status = 'playing';
                $waitingRoom->last_move_at = now();
                $waitingRoom->save();

                return response()->json([
                    'success' => true,
                    'status' => 'matched',
                    'room_id' => $waitingRoom->id,
                ]);
            }

            // Tidak ada lawan yang menunggu -> buat room baru, jadi pemain pertama (bidak PUTIH)
            $room = GameRoom::create([
                'player1_id' => $noId,
                'player2_id' => null,
                'status' => 'waiting',
                'board_state' => $this->initialBoard(),
                'turn' => 'white',
                'last_move_at' => now(),
                'white_time_left' => self::TIME_PER_PLAYER,
                'black_time_left' => self::TIME_PER_PLAYER,
            ]);

            return response()->json([
                'success' => true,
                'status' => 'waiting',
                'room_id' => $room->id,
            ]);
        });
    }

    /**
     * Batalkan pencarian lawan (hanya berlaku jika room masih berstatus 'waiting' & milik sendiri).
     */
    public function cancelMatch(Request $request): JsonResponse
    {
        $noId = session('no_id');
        if (!$noId) {
            return response()->json(['success' => false], 401);
        }

        GameRoom::where('status', 'waiting')->where('player1_id', $noId)->update(['status' => 'aborted']);

        return response()->json(['success' => true]);
    }

    /**
     * 3) Endpoint POLLING. Dipanggil berulang oleh JS (setiap 2 detik) selama mode online aktif.
     *    Mengembalikan kondisi papan, giliran, sisa waktu, dan status permainan terkini.
     *    Ini adalah inti dari teknik "HTTP Long-Polling" yang menggantikan websocket.
     */
    public function pollRoom(Request $request, $roomId): JsonResponse
    {
        $noId = session('no_id');
        if (!$noId) {
            return response()->json(['success' => false], 401);
        }

        $room = GameRoom::find($roomId);
        if (!$room) {
            return response()->json(['success' => false, 'message' => 'Room tidak ditemukan'], 404);
        }

        if ($room->player1_id !== $noId && $room->player2_id !== $noId) {
            return response()->json(['success' => false, 'message' => 'Anda bukan bagian dari room ini'], 403);
        }

        // Data lawan (nama & foto) untuk ditampilkan di panel game
        $opponentId = $room->player1_id === $noId ? $room->player2_id : $room->player1_id;
        $opponent = $opponentId
            ? DB::table('data_pelajar')->where('no_id', $opponentId)->first(['nama', 'foto'])
            : null;

        // Hitung sisa waktu SECARA REAL-TIME berdasarkan selisih waktu sejak langkah terakhir.
        // Ini penting agar timeout tetap akurat walau client polling setiap 2 detik (bukan tiap detik).
        $whiteLeft = $room->white_time_left;
        $blackLeft = $room->black_time_left;

        if ($room->status === 'playing' && $room->last_move_at) {
            $elapsed = now()->diffInSeconds($room->last_move_at);
            if ($room->turn === 'white') {
                $whiteLeft = max(0, $room->white_time_left - $elapsed);
            } else {
                $blackLeft = max(0, $room->black_time_left - $elapsed);
            }
        }

        // Deteksi timeout otomatis di sisi server (tidak bergantung client) saat sedang polling
        if ($room->status === 'playing' && ($whiteLeft <= 0 || $blackLeft <= 0)) {
            $winnerColor = $whiteLeft <= 0 ? 'black' : 'white';
            $winnerId = $winnerColor === 'white' ? $room->player1_id : $room->player2_id;
            $this->finishRoom($room, $winnerId, 'timeout');
            $room->refresh();
        }

        return response()->json([
            'success' => true,
            'status' => $room->status, // waiting | playing | finished | aborted
            'board' => $room->board_state,
            'turn' => $room->turn,
            'my_color' => $room->player1_id === $noId ? 'white' : 'black',
            'opponent' => $opponent,
            'winner_id' => $room->winner_id,
            'result_type' => $room->result_type,
            'white_time_left' => $whiteLeft,
            'black_time_left' => $blackLeft,
            'move_count' => GameMove::where('room_id', $room->id)->count(),
        ]);
    }

    /**
     * Menerima pengiriman koordinat langkah bidak dari client.
     * Validasi legalitas langkah catur (posisi bidak, aturan gerak, dsb) sudah dilakukan
     * di sisi client menggunakan chess engine JavaScript yang IDENTIK di kedua pemain.
     * Server tetap menjaga integritas dengan memvalidasi: giliran yang benar & kepemilikan room.
     */
    public function makeMove(Request $request, $roomId): JsonResponse
    {
        $noId = session('no_id');
        if (!$noId) {
            return response()->json(['success' => false], 401);
        }

        $request->validate([
            'from' => 'required|string|max:3',
            'to' => 'required|string|max:3',
            'piece' => 'required|string|max:5',
            'promotion' => 'nullable|string|max:5',
            'board_after' => 'required|array',
        ]);

        return DB::transaction(function () use ($request, $noId, $roomId) {
            $room = GameRoom::where('id', $roomId)->lockForUpdate()->first();

            if (!$room || $room->status !== 'playing') {
                return response()->json(['success' => false, 'message' => 'Game tidak aktif'], 400);
            }

            // Validasi giliran: pastikan pengirim adalah pemain yang sedang mendapat giliran
            $currentPlayerId = $room->turn === 'white' ? $room->player1_id : $room->player2_id;
            if ($currentPlayerId !== $noId) {
                return response()->json(['success' => false, 'message' => 'Bukan giliran Anda'], 403);
            }

            // Kurangi sisa waktu pemain yang baru saja melangkah, sesuai waktu yang terpakai
            $elapsed = $room->last_move_at ? now()->diffInSeconds($room->last_move_at) : 0;
            if ($room->turn === 'white') {
                $room->white_time_left = max(0, $room->white_time_left - $elapsed);
            } else {
                $room->black_time_left = max(0, $room->black_time_left - $elapsed);
            }

            // Catat langkah ke histori (game_moves)
            $moveNumber = GameMove::where('room_id', $room->id)->count() + 1;
            GameMove::create([
                'room_id' => $room->id,
                'no_id' => $noId,
                'from_square' => $request->input('from'),
                'to_square' => $request->input('to'),
                'piece' => $request->input('piece'),
                'promotion' => $request->input('promotion'),
                'move_number' => $moveNumber,
                'board_after' => $request->input('board_after'),
            ]);

            // Update posisi papan & pindahkan giliran ke lawan
            $room->board_state = $request->input('board_after');
            $room->turn = $room->turn === 'white' ? 'black' : 'white';
            $room->last_move_at = now();
            $room->save();

            return response()->json(['success' => true]);
        });
    }

    /**
     * Menandai game selesai berdasarkan hasil yang terdeteksi di client:
     * - 'win'    : pengirim mendeteksi checkmate terhadap lawan (pengirim menang)
     * - 'draw'   : stalemate / kesepakatan seri
     * - 'resign' : pengirim menyerah (otomatis kalah)
     *
     * Method ini idempotent: jika room sudah 'finished' (misal dua sisi sama-sama mengirim),
     * request kedua akan ditolak dengan aman tanpa mencatat skor ganda.
     */
    public function endGame(Request $request, $roomId): JsonResponse
    {
        $noId = session('no_id');
        if (!$noId) {
            return response()->json(['success' => false], 401);
        }

        $request->validate([
            'result' => 'required|in:win,draw,resign',
        ]);

        return DB::transaction(function () use ($request, $noId, $roomId) {
            $room = GameRoom::where('id', $roomId)->lockForUpdate()->first();

            if (!$room) {
                return response()->json(['success' => false, 'message' => 'Room tidak ditemukan'], 404);
            }
            if ($room->status !== 'playing') {
                // Sudah difinalisasi sebelumnya (misalnya oleh lawan) -> anggap sukses, tidak perlu error keras
                return response()->json(['success' => true, 'message' => 'Game sudah selesai sebelumnya']);
            }
            if ($room->player1_id !== $noId && $room->player2_id !== $noId) {
                return response()->json(['success' => false], 403);
            }

            $result = $request->input('result');

            if ($result === 'draw') {
                $this->finishRoom($room, null, 'stalemate');
            } elseif ($result === 'resign') {
                // Pengirim menyerah -> lawan otomatis menang
                $winnerId = $room->player1_id === $noId ? $room->player2_id : $room->player1_id;
                $this->finishRoom($room, $winnerId, 'resign');
            } else {
                // 'win' -> pengirim mengklaim checkmate terhadap lawan
                $this->finishRoom($room, $noId, 'checkmate');
            }

            return response()->json(['success' => true]);
        });
    }

    /**
     * Helper terpusat: finalisasi room + update poin leaderboard KEDUA pemain sekaligus.
     * Semua perubahan dibungkus transaksi agar konsisten (tidak ada skor yang "nyangkut").
     */
    private function finishRoom(GameRoom $room, ?string $winnerId, string $resultType): void
    {
        DB::transaction(function () use ($room, $winnerId, $resultType) {
            $room->status = 'finished';
            $room->winner_id = $winnerId;
            $room->result_type = $resultType;
            $room->save();

            $player1 = $room->player1_id;
            $player2 = $room->player2_id;

            // Jika belum sempat ada lawan (player2 kosong), tidak ada skor yang perlu dicatat
            if (!$player2) {
                return;
            }

            if (is_null($winnerId)) {
                // Hasil SERI: kedua pemain mendapat +1 poin
                $this->addResult($player1, 'seri');
                $this->addResult($player2, 'seri');
            } else {
                $loserId = $winnerId === $player1 ? $player2 : $player1;
                $this->addResult($winnerId, 'menang'); // +3 poin
                $this->addResult($loserId, 'kalah');   // +0 poin
            }
        });
    }

    /**
     * Menambah 1 hasil (menang/seri/kalah) untuk seorang pemain, lalu menghitung ulang total_poin.
     * Skema poin: menang = 3, seri = 1, kalah = 0.
     */
    private function addResult(string $noId, string $type): void
    {
        $row = GameLeaderboard::firstOrCreate(
            ['no_id' => $noId],
            ['menang' => 0, 'seri' => 0, 'kalah' => 0, 'total_poin' => 0]
        );

        $row->increment($type); // menambah kolom 'menang' / 'seri' / 'kalah' sebesar 1
        $row->refresh();

        $row->recalculatePoints();
        $row->save();
    }
}
