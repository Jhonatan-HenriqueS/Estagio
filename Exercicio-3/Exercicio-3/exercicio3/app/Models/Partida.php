<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partida extends Model
{
    protected $fillable = [
        'palavra_id',
    ];

    public function palavra(): BelongsTo{
        return $this->belongsTo(Palavra::class);
    }
}
