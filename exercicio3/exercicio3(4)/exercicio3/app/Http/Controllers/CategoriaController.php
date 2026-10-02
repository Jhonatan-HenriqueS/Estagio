<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Palavra;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        return view('dashboard')->with([
            'categorias' => Categoria::all(),
            'palavras' => Palavra::all()
        ]);
    }

    public function store(Request $request){
        Categoria::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('dashboard');
    }
}
