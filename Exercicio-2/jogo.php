<?php

require_once("Funcoes/funcoes.php");

$dadosCSV = extrairDados();

do{
    echo("
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo        |
                |        Opção 2 - Cadastra nova palavra    |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
    \n");

    $escolha = readline("Informe a opção desejada: ");
    echo limpar();

    switch($escolha){
        case 1:
            echo limpar();

            $placar = cadastrarJogadores();

            echo "FInalizado!\nA palavra era: " . exibirVidas(selecionarCategoria($dadosCSV), $placar);
            break;
        case 2:
            salvarPalavraCSV(criarPalavra($dadosCSV));
            break;
        case 0:
            echo "\n Finalizado! \n"; 
            break;
        default:
            echo "\n Opção inválida, tente novamente. \n";
            break;
    }
}while($escolha != 0);


