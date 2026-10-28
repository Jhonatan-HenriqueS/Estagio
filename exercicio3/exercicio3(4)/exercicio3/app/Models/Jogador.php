<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jogador extends Model
{
    protected $fillable = [
        'nome',
    ];

    public function placares(): HasMany
    {
        return $this->hasMany(Placar::class);
    }
}