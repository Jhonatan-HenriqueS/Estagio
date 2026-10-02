<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{

    protected $fillable = [
        'nome',
    ];

    public function placar()
    {
        return $this->hasOne(Placar::class);
    }

    public function partidas()
    {
        return $this->belongsToMany(
            Partida::class,
            'jogadores_partida',
            'jogador_id',
            'partida_id'
        );
    }
}
