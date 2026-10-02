<?php

namespace App\Http\Controllers;

use App\Models\Palavra;
use Illuminate\Http\Request;

class PalavraController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $palavra = new Palavra();

        $palavra->categoria_id = $request->categoria_id;
        $palavra->nome = $request->nome;

        $palavra->save();

        return redirect('/dashboard');
    }
}
