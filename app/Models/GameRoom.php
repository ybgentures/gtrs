<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameRoom extends Model
{
    protected $fillable = [
        'player1_id',
        'player2_id',
        'status',
        'board_state',
        'turn',
        'winner_id',
        'result_type',
        'last_move_at',
        'white_time_left',
        'black_time_left',
    ];

    protected $casts = [
        // board_state otomatis diubah dari/ke array PHP <-> JSON di database
        'board_state' => 'array',
        'last_move_at' => 'datetime',
    ];

    /**
     * Semua langkah yang tercatat untuk room ini, diurutkan berdasarkan urutan main.
     */
    public function moves(): HasMany
    {
        return $this->hasMany(GameMove::class, 'room_id')->orderBy('move_number');
    }
}
