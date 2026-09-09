<?php

require_once 'vendor/autoload.php';

use App\DadosCSV;
use App\Placar;
use App\JogoDaForca;

$placar = new Placar();
$dadosPalavras = new DadosCSV(__DIR__ . '/Lib/data.csv');
$dadosPlacar = new DadosCSV(__DIR__ . '/Lib/placar.csv');
$jogoForca = new JogoDaForca($placar, $dadosPalavras, $dadosPlacar);

do {
    echo "
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo        |
                |        Opção 2 - Cadastra nova palavra    |
                |        Opção 3 - Ver o Placar             |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
    \n";

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