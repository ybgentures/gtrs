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
     * Query dasar leaderboard: menggunakan nama_lengkap dan foto sesuai DB Gentures
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
                'data_pelajar.nama_lengkap as nama_lengkap', 
                'data_pelajar.foto as foto'         
            )
            ->orderByDesc('game_leaderboards.total_poin')
            ->orderByDesc('game_leaderboards.menang');
    }

    /**
     * 1) Menampilkan halaman utama game Catur 6x6 beserta leaderboard 10 besar.
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

            $ownWaiting = GameRoom::where('status', 'waiting')->where('player1_id', $noId)->first();
            if ($ownWaiting) {
                return response()->json([
                    'success' => true,
                    'status' => 'waiting',
                    'room_id' => $ownWaiting->id,
                ]);
            }

            $waitingRoom = GameRoom::where('status', 'waiting')
                ->where('player1_id', '!=', $noId)
                ->lockForUpdate()
                ->orderBy('created_at')
                ->first();

            if ($waitingRoom) {
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

            $room = GameRoom::create([
                'player1_id' => $noId,
                'player2_id' => null,
                'status' => 'waiting',
                'board_state' => $this->initialBoard(),
                'turn' => 'white',
                'last_move_at = now()',
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
     * Batalkan pencarian lawan.
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
     * 3) Endpoint POLLING.
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

        // Sudah Diperbaiki: Menggunakan alias agar aman dengan nama kolom DB Gentures
        $opponentId = $room->player1_id === $noId ? $room->player2_id : $room->player1_id;
        $opponent = $opponentId
            ? DB::table('data_pelajar')
                ->select('nama_lengkap as nama_lengkap', 'foto as foto')
                ->where('no_id', $opponentId)
                ->first()
            : null;

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

        if ($room->status === 'playing' && ($whiteLeft <= 0 || $blackLeft <= 0)) {
            $winnerColor = $whiteLeft <= 0 ? 'black' : 'white';
            $winnerId = $winnerColor === 'white' ? $room->player1_id : $room->player2_id;
            $this->finishRoom($room, $winnerId, 'timeout');
            $room->refresh();
        }

        return response()->json([
            'success' => true,
            'status' => $room->status,
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

            $currentPlayerId = $room->turn === 'white' ? $room->player1_id : $room->player2_id;
            if ($currentPlayerId !== $noId) {
                return response()->json(['success' => false, 'message' => 'Bukan giliran Anda'], 403);
            }

            $elapsed = $room->last_move_at ? now()->diffInSeconds($room->last_move_at) : 0;
            if ($room->turn === 'white') {
                $room->white_time_left = max(0, $room->white_time_left - $elapsed);
            } else {
                $room->black_time_left = max(0, $room->black_time_left - $elapsed);
            }

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

            $room->board_state = $request->input('board_after');
            $room->turn = $room->turn === 'white' ? 'black' : 'white';
            $room->last_move_at = now();
            $room->save();

            return response()->json(['success' => true]);
        });
    }

    /**
     * Menandai game selesai berdasarkan hasil yang terdeteksi di client.
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
                return response()->json(['success' => true, 'message' => 'Game sudah selesai sebelumnya']);
            }
            if ($room->player1_id !== $noId && $room->player2_id !== $noId) {
                return response()->json(['success' => false], 403);
            }

            $result = $request->input('result');

            if ($result === 'draw') {
                $this->finishRoom($room, null, 'stalemate');
            } elseif ($result === 'resign') {
                $winnerId = $room->player1_id === $noId ? $room->player2_id : $room->player1_id;
                $this->finishRoom($room, $winnerId, 'resign');
            } else {
                $this->finishRoom($room, $noId, 'checkmate');
            }

            return response()->json(['success' => true]);
        });
    }

    /**
     * Helper terpusat: finalisasi room + update poin leaderboard.
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

            if (!$player2) {
                return;
            }

            if (is_null($winnerId)) {
                $this->addResult($player1, 'seri');
                $this->addResult($player2, 'seri');
            } else {
                $loserId = $winnerId === $player1 ? $player2 : $player1;
                $this->addResult($winnerId, 'menang');
                $this->addResult($loserId, 'kalah');
            }
        });
    }

    /**
     * Menambah 1 hasil untuk seorang pemain, lalu menghitung ulang total_poin.
     */
    private function addResult(string $noId, string $type): void
    {
        $row = GameLeaderboard::firstOrCreate(
            ['no_id' => $noId],
            ['menang' => 0, 'seri' => 0, 'kalah' => 0, 'total_poin' => 0]
        );

        $row->increment($type);
        $row->refresh();

        $row->recalculatePoints();
        $row->save();
    }
}