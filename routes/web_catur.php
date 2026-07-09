<?php

/**
 * =========================================================================
 *  RUTE FITUR MINI-GAME: CATUR 6x6 (LOS ALAMOS CHESS)
 * =========================================================================
 * Cara pakai: salin blok Route di bawah ini ke dalam file routes/web.php
 * milik Anda (di bagian mana saja, asal masih di dalam middleware 'web').
 *
 * Jangan lupa tambahkan baris berikut di bagian paling atas routes/web.php:
 *   use App\Http\Controllers\GameController;
 */

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------------------------
// Halaman utama game (bisa diakses tamu, tapi fitur online & leaderboard
// hanya aktif penuh jika session('no_id') ada — dicek langsung di controller/view)
// -------------------------------------------------------------------------
Route::get('/game/catur', [GameController::class, 'index'])->name('catur.index');

// -------------------------------------------------------------------------
// API internal untuk kebutuhan leaderboard, matchmaking, dan polling.
// Semua rute ini dipakai lewat Fetch API (AJAX) dari resources/js/game/catur-game.js
// -------------------------------------------------------------------------
Route::prefix('game/catur')->name('catur.')->group(function () {

    // Refresh data leaderboard (dipanggil setelah sebuah game online selesai)
    Route::get('/leaderboard-data', [GameController::class, 'leaderboardData'])->name('leaderboardData');

    // Mulai / bergabung ke antrean matchmaking
    Route::post('/find-match', [GameController::class, 'findMatch'])->name('findMatch');

    // Batalkan pencarian lawan (saat masih status 'waiting')
    Route::post('/cancel-match', [GameController::class, 'cancelMatch'])->name('cancelMatch');

    // Endpoint POLLING: dipanggil berulang setiap 2 detik oleh JS untuk sinkronisasi real-time
    Route::get('/poll/{room}', [GameController::class, 'pollRoom'])->name('poll');

    // Kirim langkah bidak catur ke server
    Route::post('/move/{room}', [GameController::class, 'makeMove'])->name('move');

    // Tandai game selesai (checkmate/stalemate/resign) & update leaderboard
    Route::post('/end/{room}', [GameController::class, 'endGame'])->name('end');
});
