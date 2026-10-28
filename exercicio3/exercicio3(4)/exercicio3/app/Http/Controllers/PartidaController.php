<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Jogador;
use App\Models\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    private $maxErros = 6;

    public function index(Partida $partida)
    {
        $partida->load([
            'palavra.categoria',
            'placares.jogador'
        ]);

        $acertos = $partida->acertos ?? [];
        $erros = $partida->erros ?? [];

        $palavra =  strtolower($partida->palavra->nome);

        $perdeu = count($erros) >= $this->maxErros;

        $venceu = !$perdeu && count($acertos) === count(str_split($palavra));

        return view('partida', compact(
            'partida',
            'acertos',
            'erros',
            'venceu',
            'perdeu'
        ));
    }

    public function store(Request $request)
    {
        $categoria = Categoria::findOrFail($request->categoria_id);

        $palavra = $categoria->palavras()->inRandomOrder()->firstOrFail();

        $partida = Partida::create([
            'categoria_id' => $categoria->id,
            'palavra_id' => $palavra->id,
            'acertos' => [],
            'erros' => [],
        ]);

        $jogador1 = Jogador::firstOrCreate([
            'nome' => $request->jogador1_nome
        ]);

        $partida->placares()->create([
            'jogador_id' => $jogador1->id,
            'pontuacao' => 0,
        ]);

        if ($request->modo == 2) {

            $jogador2 = Jogador::firstOrCreate([
                'nome' => $request->jogador2_nome
            ]);

            $partida->placares()->create([
                'jogador_id' => $jogador2->id,
                'pontuacao' => 0,
            ]);
        }

        $partida->update([
            'jogador_atual_id' => $jogador1->id
        ]);
        return redirect()->route('partida', $partida->id);
    }

    public function tentou(Request $request, Partida $partida)
    {
        $tentativa = strtolower($request->letra);

        $palavra = strtolower($partida->palavra->nome);

        $acertos = $partida->acertos ?? [];
        $erros = $partida->erros ?? [];

        if (count($erros) >= $this->maxErros || count($acertos) === count(str_split($palavra))) {
            return back();
        }

        $placar = $partida->placares()->where('jogador_id', $partida->jogador_atual_id)->firstOrFail();

        $acertou = false;

        foreach (str_split($palavra) as $chave => $letra) {

            if ($tentativa === $letra) {
                $acertos[$chave] = $letra;
                $acertou = true;
            }
        }

        if ($acertou) {
            $placar->update([
                'pontuacao' => $placar->pontuacao + 2
            ]);

        } else {

            if (!in_array($tentativa, $erros)) {
                $erros[] = $tentativa;
            }

            $placar->update([
                'pontuacao' => max(0, $placar->pontuacao - 2)
            ]);
            
            $placares = $partida->placares;

            if ($placares->count() == 2) {

                $outroJogadorId = $placares->where('jogador_id', '!=', $partida->jogador_atual_id)->first()->jogador_id;

                $partida->update([
                    'jogador_atual_id' => $outroJogadorId
            ]);
}
        }

            $terminou = count($erros) >= $this->maxErros || count($acertos) === count(str_split($palavra));

            $partida->update([
                'acertos' => $acertos,
                'erros' => $erros,
                'encerrada_em' => $terminou ? now() : null,
            ]);
    
            return back();
        }
    }