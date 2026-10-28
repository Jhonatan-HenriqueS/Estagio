<?php
    
namespace App\Http\Controllers;

use App\Models\Jogador;
use App\Models\Placar;

class PlacarController extends Controller
{

    public function index()
    {
        return view('placar')->with([
            'jogadores' => Jogador::withCount('placares')
                ->withSum('placares', 'pontuacao')
                ->get()
        ]);
    }

}
