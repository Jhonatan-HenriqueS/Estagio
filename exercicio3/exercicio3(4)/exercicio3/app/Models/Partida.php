<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Partida extends Model
{
    protected $fillable = [
        'categoria_id',
        'palavra_id',
    ];

    protected $casts = [
        'acertos' => 'array',
        'erros' => 'array',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function palavra(): BelongsTo
    {
        return $this->belongsTo(Palavra::class);
    }

    public function jogadores(): BelongsToMany
    {
        return $this->belongsToMany(
            Jogador::class,
            'jogadores_partida',
            'partida_id',
            'jogador_id'
        );
    }


}
