<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PalavraController;
use App\Http\Controllers\PartidaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [CategoriaController::class, 'index'])->name('dashboard');
Route::get('/partida/{partida}', [PartidaController::class, 'index'])->name('partida');

Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::post('/palavras', [PalavraController::class, 'store'])->name('palavras.store');
Route::post('/partida', [PartidaController::class, 'store'])->name('partida.store');
Route::post('/partida/{partida}/tentativa', [PartidaController::class, 'tentou'])->name('partida.tentou');
