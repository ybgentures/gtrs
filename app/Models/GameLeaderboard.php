<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLeaderboard extends Model
{
    protected $fillable = [
        'no_id',
        'menang',
        'seri',
        'kalah',
        'total_poin',
    ];

    protected $casts = [
        'menang' => 'integer',
        'seri' => 'integer',
        'kalah' => 'integer',
        'total_poin' => 'integer',
    ];

    /**
     * Hitung ulang total_poin berdasarkan skema: menang=3, seri=1, kalah=0.
     * Dipanggil setiap kali jumlah menang/seri berubah.
     */
    public function recalculatePoints(): void
    {
        $this->total_poin = ($this->menang * 3) + ($this->seri * 1);
    }
}
