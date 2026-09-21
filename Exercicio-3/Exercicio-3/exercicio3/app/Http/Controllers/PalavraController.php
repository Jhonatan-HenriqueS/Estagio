<?php

namespace App\Http\Controllers;

use App\Models\Palavra;
use Illuminate\Http\Request;

class PalavraController extends Controller
{
    public function index(){
        $palavras = Palavra::all();

        return view('dashboard', compact('palavras'));
    }
}
