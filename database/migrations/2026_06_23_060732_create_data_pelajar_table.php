<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
   Schema::create('data_pelajar', function (Blueprint $table) {
        $table->id();                                    // Sudah ada
        $table->string('no_id')->unique();               // Sudah ada
        $table->string('nama_lengkap');                  // Sudah ada
        $table->string('foto')->nullable();              // Sudah ada
        
        // --- TAMBAHKAN BARIS INI ---
        $table->string('password'); 
        
        $table->timestamps();                            // Sudah ada
    });
}

    public function down(): void
    {
        Schema::dropIfExists('data_pelajar');
    }
};