<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameMove extends Model
{
    protected $fillable = [
        'room_id',
        'no_id',
        'from_square',
        'to_square',
        'piece',
        'promotion',
        'move_number',
        'board_after',
    ];

    protected $casts = [
        'board_after' => 'array',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(GameRoom::class, 'room_id');
    }
}
