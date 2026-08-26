<?php

$talhoes = [
 ['nome' => 'Talhão 9', 'cultura' => 'Soja', 'hectares' => 120.5],
 ['nome' => 'Talhão 5', 'cultura' => 'Milho', 'hectares' => 340.0],
 ['nome' => 'Talhão 8', 'cultura' => 'Soja', 'hectares' => 410.2],
 ['nome' => 'Talhão 6', 'cultura' => 'Milho', 'hectares' => 20.9],
 ['nome' => 'Talhão 3', 'cultura' => 'Mandioca', 'hectares' => 298.9],
 ['nome' => 'Talhão 4', 'cultura' => 'Mandioca', 'hectares' => 296.9],
 ['nome' => 'Talhão 1', 'cultura' => 'Ameixa', 'hectares' => 296.9],
 ['nome' => 'Talhão 2', 'cultura' => 'Amendoim', 'hectares' => 296.9],
 ['nome' => 'Talhão 7', 'cultura' => 'Soja', 'hectares' => 1020.0],
];


//Passo 1: criar um função meuUsort que ordena em ordem crescente a cultura e caso de o mesmo nome, deixa em ordem o número de hc maior

function usortCultura(array $nArray, $tipo, $ascDesc){
    $tamanho = 0;

    foreach( $nArray as $v){
        $tamanho++;
    }

    for ($i = 0; $i < $tamanho; $i++){
        $menorPalavra = $nArray[$i][$tipo];
        $posicao = $i;

        for ($j = $i; $j < $tamanho; $j++){
            if ($ascDesc == 'asc'){
                if ($menorPalavra > $nArray[$j][$tipo]){
                $menorPalavra = $nArray[$j][$tipo];
                $posicao = $j;
                }
            }
            elseif ($ascDesc == 'desc'){
                if ($menorPalavra < $nArray[$j][$tipo]){
                $menorPalavra = $nArray[$j][$tipo];
                $posicao = $j;
                }
            }
            else return "Ordem de ordenação inválida!";
        }

        $intermediador = $nArray[$i];
        $nArray[$i] = $nArray[$posicao];
        $nArray[$posicao] = $intermediador;
    }

    return $nArray;
}


