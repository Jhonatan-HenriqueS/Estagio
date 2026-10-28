<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Placar extends Model
{
    protected $fillable = [
        'partida_id',
        'jogador_id',
        'pontuacao',
    ];

    public function partida(): BelongsTo
    {
        return $this->belongsTo(Partida::class);
    }

    public function jogador(): BelongsTo
    {
        return $this->belongsTo(Jogador::class);
    }
}