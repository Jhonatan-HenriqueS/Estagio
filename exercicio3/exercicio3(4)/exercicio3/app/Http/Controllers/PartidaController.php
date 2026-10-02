<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Jogador;
use App\Models\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    /**
     * index -> listagem de todos
     * store -> criar dados
     * update -> atualizar
     * delete -> excluir
     * show -> visualizar 1 item especifico
     * partida -> store
     */



    public function index(Partida $partida)
    {
        $partida->load([
            'palavra.categoria',
            'jogadores.placar'
        ]);

        $acertos = $partida->acertos ?? [];
        $erros = $partida->erros ?? [];

        return view('partida', compact(
            'partida',
            'acertos',
            'erros'
        ));
    }

    public function store(Request $request){
        $categoria = Categoria::findOrFail($request->categoria_id);

        $palavra = $categoria->palavras()->inRandomOrder()->firstOrFail();

        $partida = Partida::create([
            'categoria_id' => $categoria->id,
            'palavra_id' => $palavra->id,
            'acertos' => [],
            'erros' => [],
        ]);

        $jogador1 = Jogador::findOrFail($request->jogador1_id);

        $partida->jogadores()->attach($jogador1->id);

        if ($request->jogador2_id) {
            $jogador2 = Jogador::findOrFail($request->jogador2_id);

            $partida->jogadores()->attach($jogador2->id);
        }

        return redirect()->route('partida', $partida->id);
    }

    public function tentou(Request $request, Partida $partida)
    {
        $tentativa = strtolower($request->letra);

        $partida->load([
            'palavra',
            'jogadores.placar'
        ]);

        $palavra = strtolower($partida->palavra->nome);

        $jogador = $partida->jogadores->first();

        $acertos = $partida->acertos ?? [];
        $erros = $partida->erros ?? [];

        $acertou = false;

        foreach (str_split($palavra) as $chave => $letra) {
            if ($tentativa === $letra) {
                $acertos[$chave] = $letra;
                $acertou = true;
            }
        }

        if ($acertou) {
            $jogador->placar->pontuacao += 2;
        } else {

            if (!in_array($tentativa, $erros)) {
                $erros[] = $tentativa;
            }

            $jogador->placar->pontuacao = max( 0, $jogador->placar->pontuacao - 1);
        }

        $jogador->placar->save();

        $partida->update([
            'acertos' => $acertos,
            'erros' => $erros,
        ]);

        return back();
    }
}
