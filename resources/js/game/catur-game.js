/**
 * =============================================================================
 *  GENTURES - CATUR 6x6 (LOS ALAMOS CHESS)
 * =============================================================================
 *  Struktur file ini dibagi menjadi 4 bagian besar:
 *   1. ENGINE   -> Aturan main catur murni (tidak menyentuh DOM sama sekali)
 *   2. RENDER   -> Menggambar papan & interaksi klik ke DOM
 *   3. MODE LOKAL (Pass & Play)
 *   4. MODE ONLINE (Matchmaking + HTTP Long-Polling)
 * =============================================================================
 */

/* ============================================================================
 * 1. ENGINE CATUR 6x6 (LOS ALAMOS CHESS)
 * ----------------------------------------------------------------------------
 * Representasi papan: array 6x6 (board[baris][kolom]).
 * - Baris index 0 = rank 6 (baris belakang HITAM, paling atas)
 * - Baris index 5 = rank 1 (baris belakang PUTIH, paling bawah)
 * - Huruf BESAR   = bidak PUTIH (R, N, Q, K, P)
 * - Huruf kecil   = bidak HITAM (r, n, q, k, p)
 * - null          = kotak kosong
 * (Tidak ada Bishop/Gajah sama sekali sesuai aturan Los Alamos Chess)
 * ==========================================================================*/
const ChessEngine = {

    // Simbol unicode ringan untuk tiap bidak (dipakai saat render, bukan gambar/image)
    SYMBOLS: {
        K: '♔', Q: '♕', R: '♖', N: '♘', P: '♙',
        k: '♚', q: '♛', r: '♜', n: '♞', p: '♟',
    },

    /** Papan awal Los Alamos Chess: baris belakang R N Q K N R (tanpa Bishop) */
    initialBoard() {
        return [
            ['r', 'n', 'q', 'k', 'n', 'r'],
            ['p', 'p', 'p', 'p', 'p', 'p'],
            [null, null, null, null, null, null],
            [null, null, null, null, null, null],
            ['P', 'P', 'P', 'P', 'P', 'P'],
            ['R', 'N', 'Q', 'K', 'N', 'R'],
        ];
    },

    inBounds(r, c) {
        return r >= 0 && r < 6 && c >= 0 && c < 6;
    },

    /** Mengembalikan 'white' / 'black' / null (jika kotak kosong) */
    colorOf(piece) {
        if (!piece) return null;
        return piece === piece.toUpperCase() ? 'white' : 'black';
    },

    /** Ubah koordinat [row,col] menjadi notasi kotak, contoh: (4,4) -> "e2" */
    toSquareName(row, col) {
        const file = String.fromCharCode(97 + col); // 97 = kode ASCII huruf 'a'
        const rank = 6 - row;
        return `${file}${rank}`;
    },

    /** Salin papan secara deep-copy agar tidak mengubah papan asli saat simulasi langkah */
    cloneBoard(board) {
        return board.map((row) => row.slice());
    },

    /**
     * Menghasilkan semua langkah PSEUDO-LEGAL (belum dicek apakah membuat raja sendiri skak)
     * untuk satu bidak di posisi (row, col).
     */
    pseudoMovesForPiece(board, row, col) {
        const piece = board[row][col];
        if (!piece) return [];

        const color = this.colorOf(piece);
        const type = piece.toUpperCase();
        const moves = [];

        // Bidak yang bergerak menyisir (sliding) sampai terhalang: Rook & Queen
        const addSliding = (directions) => {
            for (const [dr, dc] of directions) {
                let r = row + dr;
                let c = col + dc;
                while (this.inBounds(r, c)) {
                    const target = board[r][c];
                    if (!target) {
                        moves.push({ from: [row, col], to: [r, c], capture: false });
                    } else {
                        if (this.colorOf(target) !== color) {
                            moves.push({ from: [row, col], to: [r, c], capture: true });
                        }
                        break; // berhenti menyisir setelah bertemu bidak apa pun
                    }
                    r += dr;
                    c += dc;
                }
            }
        };

        // Bidak yang melangkah 1 langkah tetap: Knight & King
        const addStep = (offsets) => {
            for (const [dr, dc] of offsets) {
                const r = row + dr;
                const c = col + dc;
                if (!this.inBounds(r, c)) continue;
                const target = board[r][c];
                if (!target || this.colorOf(target) !== color) {
                    moves.push({ from: [row, col], to: [r, c], capture: !!target });
                }
            }
        };

        if (type === 'R') {
            addSliding([[0, 1], [0, -1], [1, 0], [-1, 0]]);
        } else if (type === 'Q') {
            // Queen = gabungan gerak Rook (lurus) + Bishop (diagonal), walau di game ini
            // tidak ada bidak Bishop tersendiri, Queen tetap bergerak diagonal seperti catur normal.
            addSliding([[0, 1], [0, -1], [1, 0], [-1, 0], [1, 1], [1, -1], [-1, 1], [-1, -1]]);
        } else if (type === 'N') {
            addStep([[2, 1], [2, -1], [-2, 1], [-2, -1], [1, 2], [1, -2], [-1, 2], [-1, -2]]);
        } else if (type === 'K') {
            addStep([[0, 1], [0, -1], [1, 0], [-1, 0], [1, 1], [1, -1], [-1, 1], [-1, -1]]);
            // Catatan: Tidak ada castling (rokade) di Los Alamos Chess.
        } else if (type === 'P') {
            // Putih melangkah ke arah baris berkurang (menuju row 0), Hitam ke arah baris bertambah
            const dir = color === 'white' ? -1 : 1;

            // Maju 1 kotak (aturan Los Alamos: TIDAK ADA langkah 2 kotak di awal)
            const forwardR = row + dir;
            if (this.inBounds(forwardR, col) && !board[forwardR][col]) {
                moves.push({ from: [row, col], to: [forwardR, col], capture: false });
            }

            // Menangkap diagonal (tidak ada En Passant)
            for (const dc of [-1, 1]) {
                const r = row + dir;
                const c = col + dc;
                if (this.inBounds(r, c) && board[r][c] && this.colorOf(board[r][c]) !== color) {
                    moves.push({ from: [row, col], to: [r, c], capture: true });
                }
            }
        }

        return moves;
    },

    /** Cari posisi raja milik `color`. Mengembalikan {row, col} atau null jika tidak ditemukan */
    findKing(board, color) {
        const kingChar = color === 'white' ? 'K' : 'k';
        for (let r = 0; r < 6; r++) {
            for (let c = 0; c < 6; c++) {
                if (board[r][c] === kingChar) return { row: r, col: c };
            }
        }
        return null;
    },

    /** Apakah kotak (row,col) sedang diserang oleh salah satu bidak berwarna `attackerColor`? */
    isSquareAttacked(board, row, col, attackerColor) {
        for (let r = 0; r < 6; r++) {
            for (let c = 0; c < 6; c++) {
                const piece = board[r][c];
                if (!piece || this.colorOf(piece) !== attackerColor) continue;
                const moves = this.pseudoMovesForPiece(board, r, c);
                if (moves.some((m) => m.to[0] === row && m.to[1] === col)) {
                    return true;
                }
            }
        }
        return false;
    },

    /** Apakah raja `color` sedang dalam keadaan skak (check)? */
    isInCheck(board, color) {
        const king = this.findKing(board, color);
        if (!king) return false; // seharusnya tidak terjadi dalam permainan normal
        const opponent = color === 'white' ? 'black' : 'white';
        return this.isSquareAttacked(board, king.row, king.col, opponent);
    },

    /**
     * Menerapkan sebuah langkah ke papan dan mengembalikan PAPAN BARU (tidak mengubah papan asli).
     * Menangani promosi otomatis: pion yang mencapai ujung papan lawan langsung menjadi Queen.
     */
    applyMove(board, move) {
        const newBoard = this.cloneBoard(board);
        const [fr, fc] = move.from;
        const [tr, tc] = move.to;
        let piece = newBoard[fr][fc];

        // Cek promosi: pion putih mencapai baris 0, pion hitam mencapai baris 5
        const isPawn = piece.toUpperCase() === 'P';
        const reachedLastRank = (piece === 'P' && tr === 0) || (piece === 'p' && tr === 5);
        if (isPawn && reachedLastRank) {
            // Los Alamos Chess hanya mengizinkan promosi menjadi Ratu (Queen), tidak ada pilihan lain
            piece = piece === 'P' ? 'Q' : 'q';
        }

        newBoard[tr][tc] = piece;
        newBoard[fr][fc] = null;
        return newBoard;
    },

    /** Semua langkah LEGAL (sudah difilter agar tidak membuat raja sendiri skak) untuk satu bidak */
    legalMovesForPiece(board, row, col) {
        const piece = board[row][col];
        if (!piece) return [];
        const color = this.colorOf(piece);
        const pseudo = this.pseudoMovesForPiece(board, row, col);

        return pseudo.filter((move) => {
            const simulated = this.applyMove(board, move);
            return !this.isInCheck(simulated, color);
        });
    },

    /** Semua langkah legal untuk seluruh bidak milik `color` di papan saat ini */
    allLegalMoves(board, color) {
        const all = [];
        for (let r = 0; r < 6; r++) {
            for (let c = 0; c < 6; c++) {
                const piece = board[r][c];
                if (piece && this.colorOf(piece) === color) {
                    all.push(...this.legalMovesForPiece(board, r, c));
                }
            }
        }
        return all;
    },

    /**
     * Evaluasi status permainan untuk sisi `color` yang AKAN melangkah.
     * Mengembalikan salah satu: 'checkmate' | 'stalemate' | 'insufficient' | 'ongoing'
     */
    evaluateGameStatus(board, color) {
        const legalMoves = this.allLegalMoves(board, color);

        if (legalMoves.length === 0) {
            return this.isInCheck(board, color) ? 'checkmate' : 'stalemate';
        }

        // Aturan tambahan: jika hanya tersisa Raja lawan-lawanan (tanpa bidak lain), otomatis SERI
        let nonKingPieces = 0;
        for (let r = 0; r < 6; r++) {
            for (let c = 0; c < 6; c++) {
                const p = board[r][c];
                if (p && p.toUpperCase() !== 'K') nonKingPieces++;
            }
        }
        if (nonKingPieces === 0) return 'insufficient';

        return 'ongoing';
    },
};

/* ============================================================================
 * 2. RENDER PAPAN + INTERAKSI KLIK (DOM)
 * ==========================================================================*/
class BoardRenderer {
    /**
     * @param {HTMLElement} container - elemen div#chess-board
     * @param {Function} onSquareClick - callback(row, col) dipanggil saat kotak diklik
     */
    constructor(container, onSquareClick) {
        this.container = container;
        this.onSquareClick = onSquareClick;
        this.flipped = false; // jika true, papan digambar terbalik (sudut pandang hitam)
    }

    setFlipped(flipped) {
        this.flipped = flipped;
    }

    /**
     * Menggambar ulang seluruh papan.
     * @param {Array} board - array 6x6
     * @param {Object} opts - { selected:[r,c], legalTargets:[[r,c],...], lastMove:{from,to}, checkColor }
     */
    render(board, opts = {}) {
        const { selected, legalTargets = [], lastMove, checkColor } = opts;
        this.container.innerHTML = '';

        for (let displayRow = 0; displayRow < 6; displayRow++) {
            for (let displayCol = 0; displayCol < 6; displayCol++) {
                // Jika papan dibalik (flipped), baris & kolom yang sebenarnya diakses dibalik juga
                const row = this.flipped ? 5 - displayRow : displayRow;
                const col = this.flipped ? 5 - displayCol : displayCol;

                const squareEl = document.createElement('div');
                const isLight = (row + col) % 2 === 0;
                squareEl.className = `square ${isLight ? 'light' : 'dark'}`;
                squareEl.dataset.row = row;
                squareEl.dataset.col = col;

                const piece = board[row][col];
                if (piece) {
                    squareEl.textContent = ChessEngine.SYMBOLS[piece];
                    squareEl.classList.add(ChessEngine.colorOf(piece) === 'white' ? 'piece-white' : 'piece-black');

                    // Highlight raja yang sedang skak
                    if (checkColor && piece === (checkColor === 'white' ? 'K' : 'k')) {
                        squareEl.classList.add('in-check');
                    }
                }

                if (selected && selected[0] === row && selected[1] === col) {
                    squareEl.classList.add('selected');
                }

                if (legalTargets.some((t) => t[0] === row && t[1] === col)) {
                    squareEl.classList.add(piece ? 'legal-capture' : 'legal-move');
                }

                if (lastMove && (
                    (lastMove.from[0] === row && lastMove.from[1] === col) ||
                    (lastMove.to[0] === row && lastMove.to[1] === col)
                )) {
                    squareEl.classList.add('last-move');
                }

                squareEl.addEventListener('click', () => this.onSquareClick(row, col));
                this.container.appendChild(squareEl);
            }
        }
    }
}

/* ============================================================================
 * UTILITAS UMUM
 * ==========================================================================*/
function formatClock(totalSeconds) {
    const s = Math.max(0, Math.floor(totalSeconds));
    const m = Math.floor(s / 60);
    const sisaDetik = s % 60;
    return `${String(m).padStart(2, '0')}:${String(sisaDetik).padStart(2, '0')}`;
}

function showResultModal(title, desc) {
    document.getElementById('result-title').textContent = title;
    document.getElementById('result-desc').textContent = desc;
    document.getElementById('result-modal').classList.add('show');
}

/* ============================================================================
 * 3. MODE LOKAL (PASS & PLAY - 1 PERANGKAT)
 * ----------------------------------------------------------------------------
 * Kedua pemain bergantian di perangkat yang sama. Tersedia toggle
 * "Otomatis Putar Papan" agar sudut pandang berganti setiap giliran.
 * ==========================================================================*/
class LocalGame {
    constructor(boardContainer) {
        this.renderer = new BoardRenderer(boardContainer, (r, c) => this.handleSquareClick(r, c));
        this.autoFlip = false;
        this.reset();
    }

    reset() {
        this.board = ChessEngine.initialBoard();
        this.turn = 'white';
        this.selected = null;
        this.lastMove = null;
        this.gameOver = false;

        // Timer sederhana: masing-masing 10 menit, hanya berjalan mundur saat giliran pemain tsb
        this.whiteTime = 600;
        this.blackTime = 600;
        this.clearTimer();
        this.timerInterval = setInterval(() => this.tickClock(), 1000);

        this.updateStatus('Giliran Putih (♙) untuk melangkah.');
        this.draw();
    }

    clearTimer() {
        if (this.timerInterval) clearInterval(this.timerInterval);
    }

    tickClock() {
        if (this.gameOver) return;
        if (this.turn === 'white') {
            this.whiteTime = Math.max(0, this.whiteTime - 1);
            if (this.whiteTime === 0) return this.endByTimeout('white');
        } else {
            this.blackTime = Math.max(0, this.blackTime - 1);
            if (this.blackTime === 0) return this.endByTimeout('black');
        }
        this.updateClocks();
    }

    endByTimeout(colorHabis) {
        this.gameOver = true;
        this.clearTimer();
        const pemenang = colorHabis === 'white' ? 'Hitam' : 'Putih';
        this.updateStatus(`Waktu ${colorHabis === 'white' ? 'Putih' : 'Hitam'} habis! ${pemenang} menang.`, 'win');
        showResultModal('Waktu Habis', `${pemenang} memenangkan permainan karena lawan kehabisan waktu.`);
    }

    updateClocks() {
        // Pada mode lokal, "top" selalu mewakili Hitam & "bottom" selalu mewakili Putih
        // kecuali papan sedang dibalik (autoFlip), tampilan tetap memakai posisi tetap ini
        // sedangkan orientasi VISUAL papan yang berganti.
        document.getElementById('clock-top').textContent = formatClock(this.blackTime);
        document.getElementById('clock-bottom').textContent = formatClock(this.whiteTime);
        document.getElementById('clock-top').classList.toggle('low-time', this.blackTime <= 30);
        document.getElementById('clock-bottom').classList.toggle('low-time', this.whiteTime <= 30);
    }

    updateStatus(text, kind) {
        const el = document.getElementById('status-line');
        el.textContent = text;
        el.className = 'status-line' + (kind ? ` ${kind}` : '');
    }

    handleSquareClick(row, col) {
        if (this.gameOver) return;
        const piece = this.board[row][col];

        // Kasus 1: belum ada bidak yang dipilih -> pilih bidak jika miliknya sendiri
        if (!this.selected) {
            if (piece && ChessEngine.colorOf(piece) === this.turn) {
                this.selected = [row, col];
                this.draw();
            }
            return;
        }

        // Kasus 2: klik ulang bidak yang sama -> batalkan pilihan
        if (this.selected[0] === row && this.selected[1] === col) {
            this.selected = null;
            this.draw();
            return;
        }

        // Kasus 3: klik bidak lain milik sendiri -> ganti seleksi
        if (piece && ChessEngine.colorOf(piece) === this.turn) {
            this.selected = [row, col];
            this.draw();
            return;
        }

        // Kasus 4: coba melangkah ke kotak tujuan
        const legalMoves = ChessEngine.legalMovesForPiece(this.board, this.selected[0], this.selected[1]);
        const chosenMove = legalMoves.find((m) => m.to[0] === row && m.to[1] === col);

        if (chosenMove) {
            this.executeMove(chosenMove);
        } else {
            // Klik di kotak yang bukan tujuan legal -> batalkan seleksi
            this.selected = null;
            this.draw();
        }
    }

    executeMove(move) {
        this.board = ChessEngine.applyMove(this.board, move);
        this.lastMove = move;
        this.selected = null;

        const nextTurn = this.turn === 'white' ? 'black' : 'white';
        const status = ChessEngine.evaluateGameStatus(this.board, nextTurn);

        this.turn = nextTurn;

        // Jika toggle "Otomatis Putar Papan" aktif, balik orientasi papan setiap giliran
        if (this.autoFlip) {
            this.renderer.setFlipped(this.turn === 'black');
        }

        if (status === 'checkmate') {
            this.gameOver = true;
            this.clearTimer();
            const pemenang = this.turn === 'white' ? 'Hitam' : 'Putih'; // this.turn = sisi yang TERKENA mat
            this.updateStatus(`Skakmat! ${pemenang} menang.`, 'win');
            showResultModal('Skakmat!', `${pemenang} memenangkan permainan.`);
        } else if (status === 'stalemate' || status === 'insufficient') {
            this.gameOver = true;
            this.clearTimer();
            this.updateStatus('Permainan berakhir SERI.', 'draw');
            showResultModal('Seri (Draw)', status === 'stalemate' ? 'Tidak ada langkah legal tersisa (stalemate).' : 'Bidak tersisa tidak cukup untuk melanjutkan.');
        } else {
            const inCheck = ChessEngine.isInCheck(this.board, this.turn);
            this.updateStatus(
                `Giliran ${this.turn === 'white' ? 'Putih' : 'Hitam'}${inCheck ? ' — SKAK!' : ''}`,
                inCheck ? 'lose' : undefined
            );
        }

        this.draw();
    }

    draw() {
        const legalTargets = this.selected
            ? ChessEngine.legalMovesForPiece(this.board, this.selected[0], this.selected[1]).map((m) => m.to)
            : [];

        const checkColor = !this.gameOver && ChessEngine.isInCheck(this.board, this.turn) ? this.turn : null;

        this.renderer.render(this.board, {
            selected: this.selected,
            legalTargets,
            lastMove: this.lastMove,
            checkColor,
        });
        this.updateClocks();
    }
}

/* ============================================================================
 * 4. MODE ONLINE (MATCHMAKING + HTTP LONG-POLLING)
 * ----------------------------------------------------------------------------
 * Tidak menggunakan websocket eksternal. Sinkronisasi real-time dilakukan
 * dengan Fetch API yang dipanggil berulang setiap 2 detik ke rute polling.
 * ==========================================================================*/
class OnlineGame {
    constructor(boardContainer, routes, csrfToken, myNoId) {
        this.renderer = new BoardRenderer(boardContainer, (r, c) => this.handleSquareClick(r, c));
        this.routes = routes; // { findMatch, cancelMatch, poll, move, end, leaderboard }
        this.csrfToken = csrfToken;
        this.myNoId = myNoId;

        this.roomId = null;
        this.board = null;
        this.turn = 'white';
        this.myColor = null;
        this.selected = null;
        this.lastMove = null;
        this.gameOver = false;
        this.pollTimer = null;
        this.localMoveCount = 0; // jumlah langkah yang SUDAH kita kirim, untuk deteksi update dari server
    }

    /** Helper fetch dengan header standar (CSRF + JSON) */
    async apiPost(url, body) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(body || {}),
        });
        return res.json();
    }

    async apiGet(url) {
        const res = await fetch(url, { headers: { Accept: 'application/json' } });
        return res.json();
    }

    /** Mulai proses "Cari Lawan Online" */
    async startMatchmaking() {
        document.getElementById('status-line').textContent = 'Mencari lawan...';
        const data = await this.apiPost(this.routes.findMatch);

        if (!data.success) {
            document.getElementById('status-line').textContent = data.message || 'Gagal mencari lawan.';
            return;
        }

        this.roomId = data.room_id;
        document.getElementById('btn-find-match').style.display = 'none';
        document.getElementById('btn-cancel-match').style.display = data.status === 'waiting' ? 'block' : 'none';
        document.getElementById('btn-resign').style.display = data.status === 'matched' ? 'block' : 'none';

        if (data.status === 'waiting') {
            document.getElementById('status-line').textContent = 'Menunggu lawan bergabung...';
        } else {
            document.getElementById('status-line').textContent = 'Lawan ditemukan! Permainan dimulai.';
        }

        this.startPolling();
    }

    async cancelMatchmaking() {
        await this.apiPost(this.routes.cancelMatch);
        this.stopPolling();
        document.getElementById('btn-find-match').style.display = 'block';
        document.getElementById('btn-cancel-match').style.display = 'none';
        document.getElementById('status-line').textContent = 'Pencarian dibatalkan.';
    }

    /** Inti teknik LONG-POLLING: panggil endpoint poll setiap 2 detik selama room masih aktif */
    startPolling() {
        this.stopPolling();
        this.pollTimer = setInterval(() => this.pollOnce(), 2000);
        this.pollOnce(); // panggil sekali langsung, jangan tunggu 2 detik pertama
    }

    stopPolling() {
        if (this.pollTimer) clearInterval(this.pollTimer);
        this.pollTimer = null;
    }

    async pollOnce() {
        if (!this.roomId) return;
        const data = await this.apiGet(`${this.routes.poll}/${this.roomId}`);
        if (!data.success) return;

        this.myColor = data.my_color;
        this.turn = data.turn;
        this.board = data.board;

        // Update tampilan lawan
        if (data.opponent) {
            document.getElementById('tag-top-name').textContent = data.opponent.nama || 'Lawan';
            if (data.opponent.foto) {
                document.querySelector('#tag-top img').src = `/storage/${data.opponent.foto}`;
            }
        }

        // Sinkronisasi jam berdasarkan data server (sumber kebenaran/authoritative)
        const myTime = this.myColor === 'white' ? data.white_time_left : data.black_time_left;
        const oppTime = this.myColor === 'white' ? data.black_time_left : data.white_time_left;
        document.getElementById('clock-bottom').textContent = formatClock(myTime);
        document.getElementById('clock-top').textContent = formatClock(oppTime);
        document.getElementById('clock-bottom').classList.toggle('low-time', myTime <= 30);
        document.getElementById('clock-top').classList.toggle('low-time', oppTime <= 30);

        if (data.status === 'waiting') {
            document.getElementById('status-line').textContent = 'Menunggu lawan bergabung...';
            this.renderer.render(this.board || ChessEngine.initialBoard(), {});
            return;
        }

        if (data.status === 'finished') {
            this.handleGameFinished(data);
            return;
        }

        // status === 'playing' -> render papan sesuai giliran & sudut pandang pemain (otomatis
        // berhadapan: pemain hitam melihat papan dari sudut pandangnya sendiri)
        this.renderer.setFlipped(this.myColor === 'black');
        const inCheck = ChessEngine.isInCheck(this.board, this.turn) ? this.turn : null;

        const isMyTurn = this.turn === this.myColor;
        document.getElementById('status-line').textContent = isMyTurn
            ? `Giliran Anda${inCheck === this.turn ? ' — SKAK!' : ''}`
            : `Menunggu langkah lawan${inCheck === this.turn ? ' (lawan sedang skak)' : ''}...`;

        this.draw(inCheck);
    }

    handleSquareClick(row, col) {
        if (this.gameOver || !this.board) return;
        if (this.turn !== this.myColor) return; // bukan giliran kita, abaikan klik

        const piece = this.board[row][col];

        if (!this.selected) {
            if (piece && ChessEngine.colorOf(piece) === this.myColor) {
                this.selected = [row, col];
                this.draw();
            }
            return;
        }

        if (this.selected[0] === row && this.selected[1] === col) {
            this.selected = null;
            this.draw();
            return;
        }

        if (piece && ChessEngine.colorOf(piece) === this.myColor) {
            this.selected = [row, col];
            this.draw();
            return;
        }

        const legalMoves = ChessEngine.legalMovesForPiece(this.board, this.selected[0], this.selected[1]);
        const chosenMove = legalMoves.find((m) => m.to[0] === row && m.to[1] === col);

        if (chosenMove) {
            this.submitMove(chosenMove);
        } else {
            this.selected = null;
            this.draw();
        }
    }

    /** Terapkan langkah secara optimis di layar, lalu kirim ke server */
    async submitMove(move) {
        const movingPiece = this.board[move.from[0]][move.from[1]];
        const newBoard = ChessEngine.applyMove(this.board, move);

        const opponentColor = this.myColor === 'white' ? 'black' : 'white';
        const status = ChessEngine.evaluateGameStatus(newBoard, opponentColor);

        // Update tampilan lokal dulu (optimistic update) supaya terasa responsif
        this.board = newBoard;
        this.lastMove = move;
        this.selected = null;
        this.turn = opponentColor;
        this.draw();

        const isPromotion = movingPiece.toUpperCase() === 'P' &&
            ((movingPiece === 'P' && move.to[0] === 0) || (movingPiece === 'p' && move.to[0] === 5));

        // Kirim langkah ke server
        await this.apiPost(`${this.routes.move}/${this.roomId}`, {
            from: ChessEngine.toSquareName(move.from[0], move.from[1]),
            to: ChessEngine.toSquareName(move.to[0], move.to[1]),
            piece: movingPiece,
            promotion: isPromotion ? (this.myColor === 'white' ? 'Q' : 'q') : null,
            board_after: newBoard,
        });

        // Jika langkah kita barusan membuat lawan checkmate/stalemate, laporkan hasil akhir ke server
        if (status === 'checkmate') {
            await this.apiPost(`${this.routes.end}/${this.roomId}`, { result: 'win' });
        } else if (status === 'stalemate' || status === 'insufficient') {
            await this.apiPost(`${this.routes.end}/${this.roomId}`, { result: 'draw' });
        }

        // Lanjutkan polling seperti biasa untuk menunggu giliran lawan
        this.pollOnce();
    }

    async resign() {
        if (!this.roomId) return;
        if (!confirm('Yakin ingin menyerah? Anda akan tercatat kalah.')) return;
        await this.apiPost(`${this.routes.end}/${this.roomId}`, { result: 'resign' });
        this.pollOnce();
    }

    handleGameFinished(data) {
        this.gameOver = true;
        this.stopPolling();
        this.renderer.render(data.board, {});

        document.getElementById('btn-find-match').style.display = 'block';
        document.getElementById('btn-cancel-match').style.display = 'none';
        document.getElementById('btn-resign').style.display = 'none';

        let title = 'Permainan Selesai';
        let desc = '';
        let statusText = '';
        let statusKind = 'draw';

        if (data.result_type === 'stalemate' || data.result_type === 'draw') {
            title = 'Seri (Draw)';
            desc = 'Pertandingan berakhir seri.';
            statusText = 'Hasil: Seri';
        } else {
            const menang = data.winner_id === this.myNoId;
            statusKind = menang ? 'win' : 'lose';
            title = menang ? 'Anda Menang! 🎉' : 'Anda Kalah';
            const alasan = {
                checkmate: 'skakmat',
                resign: 'lawan menyerah/menyerah',
                timeout: 'waktu habis',
            }[data.result_type] || 'permainan berakhir';
            desc = menang ? `Anda menang karena ${alasan}.` : `Anda kalah karena ${alasan}.`;
            statusText = menang ? 'Anda Menang!' : 'Anda Kalah';
        }

        document.getElementById('status-line').textContent = statusText;
        document.getElementById('status-line').className = `status-line ${statusKind}`;
        showResultModal(title, desc);

        // Refresh leaderboard karena poin baru saja berubah di server
        refreshLeaderboard(this.routes.leaderboard, this.myNoId);
    }

    draw(checkColor) {
        const legalTargets = this.selected
            ? ChessEngine.legalMovesForPiece(this.board, this.selected[0], this.selected[1]).map((m) => m.to)
            : [];

        this.renderer.render(this.board, {
            selected: this.selected,
            legalTargets,
            lastMove: this.lastMove,
            checkColor: checkColor || null,
        });
    }
}

/** Ambil ulang data leaderboard via AJAX dan render ulang tabelnya */
async function refreshLeaderboard(url, myNoId) {
    try {
        const res = await fetch(url, { headers: { Accept: 'application/json' } });
        const data = await res.json();
        if (!data.success) return;

        const tbody = document.getElementById('leaderboard-body');
        tbody.innerHTML = '';

        data.data.forEach((row, i) => {
            const tr = document.createElement('tr');
            if (String(row.no_id) === String(myNoId)) tr.classList.add('lb-me-row');

            const fotoUrl = row.foto_pelajar ? `/storage/${row.foto_pelajar}` : '/images/default_img.webp';
            const nama = row.nama_pelajar || `Pemain #${row.no_id}`;

            tr.innerHTML = `
                <td class="lb-rank">${i + 1}</td>
                <td>
                    <div class="lb-player">
                        <img src="${fotoUrl}" alt="">
                        <span>${nama}</span>
                    </div>
                </td>
                <td class="lb-wdl">
                    <span class="lb-w">${row.menang}M</span>
                    <span class="lb-d">${row.seri}S</span>
                    <span class="lb-l">${row.kalah}K</span>
                </td>
                <td class="lb-points">${row.total_poin}</td>
            `;
            tbody.appendChild(tr);
        });
    } catch (e) {
        // Diamkan saja jika refresh leaderboard gagal, tidak kritikal untuk gameplay
        console.error('Gagal memuat leaderboard:', e);
    }
}

/* ============================================================================
 * INISIALISASI HALAMAN
 * ==========================================================================*/
document.addEventListener('DOMContentLoaded', () => {
    const appEl = document.getElementById('catur-app');
    if (!appEl) return; // halaman ini bukan halaman catur, keluar

    const isLoggedIn = appEl.dataset.loggedIn === '1';
    const myNoId = appEl.dataset.noId;
    const csrfToken = appEl.dataset.csrf;

    const routes = {
        findMatch: appEl.dataset.routeFindMatch,
        cancelMatch: appEl.dataset.routeCancelMatch,
        poll: appEl.dataset.routePoll,
        move: appEl.dataset.routeMove,
        end: appEl.dataset.routeEnd,
        leaderboard: appEl.dataset.routeLeaderboard,
    };

    const boardContainer = document.getElementById('chess-board');
    let localGame = null;
    let onlineGame = null;

    // --------- Setup Mode Lokal (default aktif saat halaman dibuka) ---------
    localGame = new LocalGame(boardContainer);

    document.getElementById('toggle-autoflip').addEventListener('change', (e) => {
        localGame.autoFlip = e.target.checked;
        if (!e.target.checked) localGame.renderer.setFlipped(false);
        localGame.draw();
    });

    document.getElementById('btn-new-local').addEventListener('click', () => {
        localGame.reset();
    });

    // --------- Tab switching: Lokal <-> Online ---------
    const tabLocal = document.getElementById('tab-local');
    const tabOnline = document.getElementById('tab-online');
    const panelLocal = document.getElementById('panel-local');
    const panelOnline = document.getElementById('panel-online');

    tabLocal.addEventListener('click', () => {
        tabLocal.classList.add('active');
        tabOnline.classList.remove('active');
        panelLocal.style.display = 'block';
        panelOnline.style.display = 'block' === panelOnline.style.display ? 'none' : 'none';
        panelOnline.style.display = 'none';

        // Hentikan polling online jika sedang berjalan, kembali ke tampilan lokal
        if (onlineGame) onlineGame.stopPolling();
        localGame.draw();
    });

    tabOnline.addEventListener('click', () => {
        tabOnline.classList.add('active');
        tabLocal.classList.remove('active');
        panelOnline.style.display = 'block';
        panelLocal.style.display = 'none';
    });

    // --------- Setup Mode Online (hanya jika user sudah login) ---------
    if (isLoggedIn) {
        onlineGame = new OnlineGame(boardContainer, routes, csrfToken, myNoId);

        document.getElementById('btn-find-match').addEventListener('click', () => {
            onlineGame.startMatchmaking();
        });
        document.getElementById('btn-cancel-match').addEventListener('click', () => {
            onlineGame.cancelMatchmaking();
        });
        document.getElementById('btn-resign').addEventListener('click', () => {
            onlineGame.resign();
        });
    }

    // --------- Tombol tutup modal hasil ---------
    document.getElementById('result-close-btn').addEventListener('click', () => {
        document.getElementById('result-modal').classList.remove('show');
    });
});
