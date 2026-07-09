{{-- 1. PANGGIL NAVBAR DI BAGIAN PALING ATAS --}}
@include('layouts.nav')

{{-- Trik JS agar judul tab browser berubah sesuai keinginanmu tanpa layout master --}}
<script>document.title = "Catur 6x6 - Los Alamos Chess | Gentures";</script>

{{--
    =====================================================================
    HALAMAN GAME: CATUR 6x6 (LOS ALAMOS CHESS)
    - Sudah disesuaikan dengan sistem @include Gentures
    - Data session dikirim ke JS lewat atribut data-* pada #catur-app
    =====================================================================
--}}

<div class="catur-wrapper"
     id="catur-app"
     data-logged-in="{{ $isLoggedIn ? '1' : '0' }}"
     data-no-id="{{ $noId }}"
     data-nama="{{ session('nama') }}"
     data-foto="{{ session('foto') ? asset('img/' . session('foto')) : asset('images/default_img.webp') }}"
     data-route-find-match="{{ route('catur.findMatch') }}"
     data-route-cancel-match="{{ route('catur.cancelMatch') }}"
     data-route-poll="{{ url('/game/catur/poll') }}"
     data-route-move="{{ url('/game/catur/move') }}"
     data-route-end="{{ url('/game/catur/end') }}"
     data-route-leaderboard="{{ route('catur.leaderboardData') }}"
     data-csrf="{{ csrf_token() }}">

    <div class="catur-header">
        <h1>♟ Catur 6x6 &mdash; Los Alamos Chess</h1>
        <p>Versi catur klasik pertama di dunia yang dimainkan komputer (1956) &mdash; papan 6x6, tanpa Gajah.</p>
    </div>

    <div class="catur-layout">

        {{-- ============================= KOLOM KIRI: PAPAN + PANEL KONTROL ============================= --}}
        <div>
            <div class="gn-card board-area">
                <h2>♞ Papan Permainan</h2>

                {{-- Info pemain atas (lawan / pemain 2) --}}
                <div class="board-topbar">
                    <div class="player-tag" id="tag-top">
                        <img src="{{ asset('images/default_img.webp') }}" alt="">
                        <span id="tag-top-name">Menunggu...</span>
                    </div>
                    <div class="player-clock" id="clock-top">10:00</div>
                </div>

                {{-- Papan 6x6 dirender penuh oleh JavaScript (36 kotak) --}}
                <div class="chess-board" id="chess-board"></div>

                {{-- Info pemain bawah (diri sendiri / pemain 1) --}}
                <div class="board-topbar" style="margin-top:12px;">
                    <div class="player-tag" id="tag-bottom">
                        <img src="{{ $isLoggedIn ? (session('foto') ? asset('img/' . session('foto')) : asset('images/default_img.webp')) : asset('images/default_img.webp') }}" alt="">
                        <span id="tag-bottom-name">{{ $isLoggedIn ? session('nama') : 'Tamu (Pass & Play)' }}</span>
                    </div>
                    <div class="player-clock" id="clock-bottom">10:00</div>
                </div>

                <div class="status-line" id="status-line">Pilih mode permainan di panel kanan untuk memulai.</div>
            </div>
        </div>

        {{-- ============================= KOLOM KANAN: KONTROL + LEADERBOARD ============================= --}}
        <div>
            {{-- ---------- PANEL KONTROL MODE ---------- --}}
            <div class="gn-card">
                <h2>⚙ Mode Permainan</h2>

                <div class="mode-tabs">
                    <button type="button" class="mode-tab-btn active" data-mode="local" id="tab-local">
                        1 Perangkat
                    </button>
                    <button type="button" class="mode-tab-btn" data-mode="online" id="tab-online">
                        Online
                    </button>
                </div>

                {{-- Panel Mode LOKAL --}}
                <div id="panel-local">
                    <div class="toggle-row">
                        <span>Otomatis Putar Papan</span>
                        <label class="gn-switch">
                            <input type="checkbox" id="toggle-autoflip">
                            <span class="gn-switch-track"></span>
                        </label>
                    </div>
                    <button type="button" class="gn-btn gn-btn-primary" id="btn-new-local">
                        ♟ Mulai Permainan Baru
                    </button>
                </div>

                {{-- Panel Mode ONLINE --}}
                <div id="panel-online" style="display:none;">
                    @if($isLoggedIn)
                        <button type="button" class="gn-btn gn-btn-primary" id="btn-find-match">
                            🔍 Cari Lawan Online
                        </button>
                        <button type="button" class="gn-btn gn-btn-outline" id="btn-cancel-match" style="display:none;">
                            ✖ Batalkan Pencarian
                        </button>
                        <button type="button" class="gn-btn gn-btn-danger" id="btn-resign" style="display:none;">
                            🏳 Menyerah
                        </button>
                    @else
                        <p class="leaderboard-guest-msg">
                            Anda harus <a href="{{ route('login') }}">login terlebih dahulu</a>
                            untuk bermain mode online dan masuk ke papan peringkat.
                        </p>
                    @endif
                </div>
            </div>

            {{-- ---------- LEADERBOARD ---------- --}}
            <div class="gn-card">
                <h2>🏆 Papan Peringkat (Top 10)</h2>

                @if(!$isLoggedIn)
                    <div class="leaderboard-guest-msg">
                        Login untuk melihat peringkat Anda dan bersaing masuk 10 besar.<br>
                        <a href="{{ route('login') }}">Login sekarang &rarr;</a>
                    </div>
                @endif

                <table class="lb-table" id="leaderboard-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pemain</th>
                            <th>W-D-L</th>
                            <th style="text-align:right;">Poin</th>
                        </tr>
                    </thead>
                    <tbody id="leaderboard-body">
                        @forelse($leaderboard as $i => $row)
                            <tr class="{{ $isLoggedIn && $row->no_id == $noId ? 'lb-me-row' : '' }}">
                                <td class="lb-rank">{{ $i + 1 }}</td>
                                <td>
                                    <div class="lb-player">
                                        <img src="{{ $row->foto_pelajar ? asset('img/'.$row->foto_pelajar) : asset('images/default_img.webp') }}" alt="">
                                        <span>{{ $row->nama_pelajar ?? 'Pemain #'.$row->no_id }}</span>
                                    </div>
                                </td>
                                <td class="lb-wdl">
                                    <span class="lb-w">{{ $row->menang }}M</span>
                                    <span class="lb-d">{{ $row->seri }}S</span>
                                    <span class="lb-l">{{ $row->kalah }}K</span>
                                </td>
                                <td class="lb-points">{{ $row->total_poin }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" style="text-align:center;color:gray;padding:16px 0;">Belum ada data. Jadilah yang pertama!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ---------- MODAL HASIL PERTANDINGAN ---------- --}}
<div class="gn-modal-backdrop" id="result-modal">
    <div class="gn-modal">
        <h3 id="result-title">Permainan Selesai</h3>
        <p id="result-desc"></p>
        <button type="button" class="gn-btn gn-btn-primary" id="result-close-btn">Tutup</button>
    </div>
</div>

{{-- 2. LOAD ASET CSS & JAVASCRIPT VITE SECARA LANGSUNG --}}
@vite(['resources/css/catur.css', 'resources/js/game/catur-game.js'])

{{-- 3. PANGGIL FOOTER DI BAGIAN PALING BAWAH --}}
@include('layouts.footer')