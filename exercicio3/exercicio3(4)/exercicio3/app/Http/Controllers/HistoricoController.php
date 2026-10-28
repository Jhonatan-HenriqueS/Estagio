<?php

namespace App\Http\Controllers;

use App\Models\Partida;

class HistoricoController extends Controller
{
    private  $maxErros = 6;

    public function index()
    {
        $partidas = Partida::with([
            'palavra.categoria',
            'placares.jogador'
        ])->latest()->get();

        foreach ($partidas as $partida) {
            $acertos = count($partida->acertos ?? []);
            $erros = count($partida->erros ?? []);

            $perdida = $erros >= $this->maxErros;
            $finalizada = !$perdida && $acertos === mb_strlen($partida->palavra->nome);

            $encerrada = $partida->encerrada_em ?? ($perdida || $finalizada ? $partida->updated_at : null);

            $vencedor = $partida->placares->count() > 1
                ? $partida->placares->sortByDesc('pontuacao')->first()
                : null;

            $partida->total_acertos = $acertos;
            $partida->total_erros = $erros;
            $partida->perdida = $perdida;
            $partida->finalizada = $finalizada;
            $partida->duracao = $encerrada
                ? gmdate('H:i:s', abs($partida->created_at->diffInSeconds($encerrada)))
                : null;
            $partida->vencedor_id = $vencedor?->id;
        }

        return view('historico')->with([
            'partidas' => $partidas
        ]);
    }
}
