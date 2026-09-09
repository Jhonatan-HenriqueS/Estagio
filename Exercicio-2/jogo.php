<?php

require_once 'vendor/autoload.php';

use App\DadosCSV;
use App\Placar;
use App\JogoDaForca;

$placar = new Placar();
$dadosPalavras = new DadosCSV( __DIR__ . '/../Lib/data.csv');
$jogo = new JogoDaForca($placar, $dadosPalavras);

do {
    echo "
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo        |
                |        Opção 2 - Cadastra nova palavra    |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
    \n";

    $escolha = readline("Informe a opção desejada: ");
    echo $jogo->limpar();

    switch ($escolha) {
        case 1:
            $jogo->iniciar();
            break;
        case 2:
            $jogo->adicionarPalavra();
            break;
        case 0:
            echo "\n Finalizado! \n";
            break;
        default:
            echo "\n Opção inválida, tente novamente. \n";
            break;
    }
} while ($escolha != 0);