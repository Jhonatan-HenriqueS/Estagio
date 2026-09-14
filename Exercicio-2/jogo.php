<?php

require_once 'vendor/autoload.php';

use App\DadosCSV;
use App\Placar;
use App\JogoDaForca;

$placar = new Placar();
$dadosPalavras = new DadosCSV(__DIR__ . '/Lib/data.csv');
$dadosPlacar = new DadosCSV(__DIR__ . '/Lib/placar.csv');
$jogoForca = new JogoDaForca($placar, $dadosPalavras, $dadosPlacar);

$opcoesMenu = ["Sair", "Iniciar novo jogo", "Cadastrar nova palavra", "Ver o Placar"];

do {

    echo "
    \t+-----------------------------------------+
    \t|               MENU GAMEPLAY             |
    \t+-----------------------------------------+
    ";
    foreach ($opcoesMenu as $i => $categoria) {
        $i++;
        echo "\t| Opção $i: " . str_pad($categoria, 30, " ", STR_PAD_BOTH) . " | \n";
    }
    echo "\t+-----------------------------------------+\n\n";

    echo "\t";
    $escolha = readline("Informe a opção desejada: ");
    echo $jogoForca->limpar();

    switch ($escolha) {
        case 1:
            $jogoForca->iniciar();
            break;
        case 2:
            $jogoForca->adicionarPalavra();
            break;
        case 3:
            $jogoForca->exibirPlacar();
            break;
        case 0:
            echo "\n Finalizado! \n";
            break;
        default:
            echo "\n Opção inválida, tente novamente. \n";
            break;
    }
} while ($escolha != 0);