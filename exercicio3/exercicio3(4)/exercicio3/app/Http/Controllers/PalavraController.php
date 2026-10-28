<?php

namespace App\Http\Controllers;

use App\Models\Palavra;
use Illuminate\Http\Request;

class PalavraController extends Controller
{
    public function index(){

    }

    public function store(Request $request){

        $request->validate(
            [
                'nome' => 'required|unique:palavras,nome',
            ],
            [
                'nome.required' => 'Informe o nome da palavra.',
                'nome.unique' => 'Essa palavra já existe.',
            ]
        );

        Palavra::create([
            'categoria_id' => $request->categoria_id,
            'nome' => $request->nome,
        ]);

        

        return redirect()->route('dashboard')->with('sucesso', 'Palavra criada com sucesso!');
    }
}
