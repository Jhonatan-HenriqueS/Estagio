<?php

require("Funcoes/funcoes.php");

$dadosCSV = extrairDados();
$forca = ["casa", "carro", "livro", "computador", "guarda-chuva", "pe-de-muleque"];

do{
    echo("
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo        |
                |        Opção 2 - Cadastra nova palavra   |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
    \n");

    $escolha = readline("Informe a opção desejada: ");
    echo limpar();

    switch($escolha){
        case 1:
            echo limpar();
            
            $placar = [
               readline("Informe o nome do jogaor 1: ") => 0,
               readline("Informe o nome do jogaor 2: ") => 0
            ];

            echo "FInalizado!\nA palavra era: " . exibirVidas(verificarCategoria($dadosCSV, true), $placar);
            break;
        case 2:
            adicionarPalavra(selecionarPalavra($dadosCSV));
            break;
        case 0:
            echo "\n Finalizado! \n"; 
            break;
        default:
            echo "\n Opção inválida, tente novamente. \n";
            break;
    }
}while($escolha != 0);


