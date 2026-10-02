<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{

    protected $fillable = [
        'nome',
    ];

    public function palavras(): HasMany 
    {
        return $this->hasMany(Palavra::class);
    }
}