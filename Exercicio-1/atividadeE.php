<?php

echo("
                |------------------------------------|
                |        Opção 1 - Atividade A       |
                |        Opção 2 - Atividade B       |
                |        Opção 3 - atividade E       |
                |------------------------------------| 
\n");

$escolha = readline("Escolha a opção desejada: ");

echo $escolha;



//Criar uma função meuShuffle que ordena 60 mil vezes um array de A, B, C


$letras = ['A', 'B', 'C'];

function meuShuffle(array $array) {
    $tamanho = 0;
    foreach ($array as $v) {
        $tamanho++;
    }

    for ($i = $tamanho - 1; $i > 0; $i--) {
        $sortido = mt_rand(0, $i);
        $intermediador = $array[$i];
        $array[$i] = $array[$sortido];
        $array[$sortido] = $intermediador;
    }

    return $array;
}

function tabelaRepeticoes(array $nArray){

$repeticoes = [];

for ($i = 0; $i < 60000; $i++) {
    $embaralhado = meuShuffle($nArray);
    $chave = "";

    foreach ($embaralhado as $letra) {
        $chave = $chave . $letra;
    }
    
    $repeticoes[$chave]++;
}

return $repeticoes;
}

foreach (tabelaRepeticoes($letras) as $chaves => $quantidade) {
    echo "A ordem $chaves, se repetiu $quantidade vezes\n";
}