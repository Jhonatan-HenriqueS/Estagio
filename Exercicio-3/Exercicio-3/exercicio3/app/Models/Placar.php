<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Placar extends Model
{
    protected $fillable = [
        'jogador_id',
        'pontuacao',
    ];

    public function jogador(): BelongsTo {
        return $this->belongsTo(Jogador::class);
    }
}