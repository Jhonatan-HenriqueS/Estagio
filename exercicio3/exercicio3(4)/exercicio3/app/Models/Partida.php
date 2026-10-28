<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partida extends Model
{
    protected $fillable = [
        'categoria_id',
        'palavra_id',
        'jogador_atual_id',
        'acertos',
        'erros',
        'encerrada_em',
    ];

    protected $casts = [
        'acertos' => 'array',
        'erros' => 'array',
        'encerrada_em' => 'datetime',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function palavra(): BelongsTo
    {
        return $this->belongsTo(Palavra::class);
    }

    public function placares(): HasMany
    {
        return $this->hasMany(Placar::class);
    }

    public function jogadorAtual(): BelongsTo
    {
        return $this->belongsTo(Jogador::class, 'jogador_atual_id');
    }
}