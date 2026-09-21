<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Palavra extends Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
    ];

    public function categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class);
    }
}
