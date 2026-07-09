<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel papan peringkat (leaderboard) global untuk mode Online.
     * 1 baris = 1 pemain (berdasarkan no_id yang berelasi ke tabel data_pelajar).
     *
     * Skema poin (sesuai aturan yang diminta):
     *   menang = 3 poin
     *   seri   = 1 poin
     *   kalah  = 0 poin
     */
    public function up(): void
    {
        Schema::create('game_leaderboards', function (Blueprint $table) {
            $table->id();

            // Relasi ke data_pelajar.no_id (tidak pakai foreign key constraint keras
            // agar migrasi ini tetap aman dijalankan meskipun struktur data_pelajar berbeda-beda)
            $table->string('no_id')->unique();

            $table->unsignedInteger('menang')->default(0);
            $table->unsignedInteger('seri')->default(0);
            $table->unsignedInteger('kalah')->default(0);

            // total_poin = (menang * 3) + (seri * 1). Disimpan sebagai kolom fisik (bukan dihitung on-the-fly)
            // supaya query ORDER BY untuk leaderboard cepat dan mudah di-index.
            $table->unsignedInteger('total_poin')->default(0);

            $table->timestamps();

            // Index untuk mempercepat query "top 10 leaderboard"
            $table->index(['total_poin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_leaderboards');
    }
};
