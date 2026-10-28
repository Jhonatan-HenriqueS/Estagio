<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Palavra;
use App\Models\Partida;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        return view('dashboard')->with([
            'categorias' => Categoria::all(),
            'palavras' => Palavra::all(),
            'partida' => Partida::count()
        ]);
    }

    public function store(Request $request){
        $request->validate(
            [
                'nome' => 'required|unique:categorias,nome',
            ],
            [
                'nome.required' => 'Informe o nome da categoria.',
                'nome.unique' => 'Essa categoria já existe.',
            ]
        );

        Categoria::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('dashboard')->with('sucesso', 'Categoria criada com sucesso!');
    }
}
