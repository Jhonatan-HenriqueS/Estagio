<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboards', function () {
    $jogadores = [
        "Jhonatan" => 12,
        "Thalys" => 22,
        "Eloyze" => 12,
    ];

    $titulo = "Página de dashboard";

    return view('dashboards', 
    ['jogadores' => $jogadores],
    ['titulo' => $titulo]);

});


