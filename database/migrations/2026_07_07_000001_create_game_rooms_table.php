<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini menyimpan setiap "ruang permainan" (room) untuk mode Online.
     * Satu baris = satu pertandingan antara 2 pemain (atau 1 pemain yang masih menunggu lawan).
     */
    public function up(): void
    {
        Schema::create('game_rooms', function (Blueprint $table) {
            $table->id();

            // no_id pemain 1 (selalu bermain sebagai bidak PUTIH / white)
            $table->string('player1_id');

            // no_id pemain 2 (selalu bermain sebagai bidak HITAM / black), null selama masih menunggu lawan
            $table->string('player2_id')->nullable();

            // Status siklus hidup room:
            // waiting  -> baru dibuat, menunggu lawan (matchmaking)
            // playing  -> sudah ada 2 pemain, sedang berjalan
            // finished -> selesai (checkmate/stalemate/resign/timeout)
            // aborted  -> dibatalkan sebelum ada lawan
            $table->enum('status', ['waiting', 'playing', 'finished', 'aborted'])->default('waiting');

            // Representasi papan 6x6 dalam bentuk array JSON (baris x kolom).
            // Contoh 1 baris: ["r","n","q","k","n","r"]
            $table->json('board_state')->nullable();

            // Giliran saat ini
            $table->enum('turn', ['white', 'black'])->default('white');

            // no_id pemenang. Null jika seri atau belum selesai.
            $table->string('winner_id')->nullable();

            // Alasan permainan berakhir
            $table->enum('result_type', ['checkmate', 'stalemate', 'resign', 'timeout', 'draw'])->nullable();

            // Kapan langkah terakhir dibuat. Dipakai untuk menghitung sisa waktu (clock) secara akurat
            // walaupun client tidak selalu online / polling bisa telat.
            $table->timestamp('last_move_at')->nullable();

            // Sisa waktu berpikir masing-masing warna, dalam detik. Default 10 menit (600 detik).
            $table->unsignedInteger('white_time_left')->default(600);
            $table->unsignedInteger('black_time_left')->default(600);

            $table->timestamps();

            // Index untuk mempercepat query pencarian room yang masih 'waiting' atau milik user tertentu
            $table->index(['status']);
            $table->index(['player1_id']);
            $table->index(['player2_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_rooms');
    }
};
