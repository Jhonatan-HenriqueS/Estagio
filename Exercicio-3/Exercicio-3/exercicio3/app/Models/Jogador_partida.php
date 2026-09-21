<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jogador_partida extends Model
{
    protected $table = 'jogadores_partida';

    protected $fillable = [
        'jogador_id',
        'partida_id'
    ];

    public function jogador(): BelongsTo{
        return $this->belongsTo(Jogador::class);
    }

    public function partida(): BelongsTo{
        return $this->belongsTo(Partida::class);
    }
}
