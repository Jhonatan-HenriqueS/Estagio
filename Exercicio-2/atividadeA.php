<?php

$forca = ["casa", "carro", "livro", "computador", "janela", "porta", "cadeira", "mesa", "telefone", "lapis"];

do{
    echo("
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo        |
                |        Opção 2 - Sair                     |
                |-------------------------------------------| 
\n");

$escolha = readline("Informe a opção desejada: ");
popen('cls', 'w');

    switch($escolha){
        case 1: 
             [$sublinhado, $palavra] = exibirSublinhado($forca);
             
             echo "Palavra sortiada $palavra \n";
             echo $sublinhado;
            break;
        case 0:
            echo "Finalizado! \n";
        default:
            echo "Opção inválida, tente novamente.";
            break;
    }
}while($escolha != 0);

function exibirSublinhado(array $nArray){

    $chave = array_rand($nArray);
    $palavraSortiada = str_split($nArray[$chave]);
    
    $sublinhados = "";
    foreach ($palavraSortiada as $_){
        $sublinhados .= "_";
    }

    return [$sublinhados, $palavraSortiada];
}

