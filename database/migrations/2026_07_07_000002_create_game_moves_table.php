<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini menyimpan histori setiap langkah (move) yang terjadi di sebuah room.
     * Berguna untuk: audit, replay pertandingan, dan menghitung nomor urut langkah (move_number)
     * yang dipakai sistem polling untuk tahu apakah ada langkah baru dari lawan.
     */
    public function up(): void
    {
        Schema::create('game_moves', function (Blueprint $table) {
            $table->id();

            // Relasi ke room tempat langkah ini terjadi
            $table->foreignId('room_id')->constrained('game_rooms')->onDelete('cascade');

            // no_id pemain yang melakukan langkah ini
            $table->string('no_id');

            // Notasi kotak asal & tujuan, contoh: "e2" -> "e4"
            $table->string('from_square', 3);
            $table->string('to_square', 3);

            // Jenis bidak yang bergerak, contoh: "P" (pion putih) atau "n" (kuda hitam)
            $table->string('piece', 5);

            // Jika pion promosi, selalu "Q"/"q" (Los Alamos Chess hanya mengizinkan promosi ke Ratu)
            $table->string('promotion', 5)->nullable();

            // Urutan langkah dalam room ini (1, 2, 3, ...) — dipakai untuk sinkronisasi polling
            $table->unsignedInteger('move_number');

            // Snapshot papan LENGKAP setelah langkah ini dieksekusi (JSON array 6x6)
            $table->json('board_after');

            $table->timestamps();

            $table->index(['room_id', 'move_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_moves');
    }
};
