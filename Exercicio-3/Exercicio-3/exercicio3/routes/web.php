<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PalavraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PalavraController::class, 'index']);
Route::get('/dashboard', [CategoriaController::class, 'index']);

