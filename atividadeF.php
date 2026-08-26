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

$tamanho = 0;

foreach( $talhoes as $v){
    $tamanho++;
}

//Passo 1: criar um função meuUsort que ordena em ordem crescente a cultura e caso de o mesmo nome, deixa em ordem o número de hc maior

function usortCultura(array $nArray, $tamanhoArray, $culturaHec){

    for ($i = 0; $i < $tamanhoArray; $i++){
        $menorPalavra = $nArray[$i][$culturaHec];
        $posicao = $i;

        for ($j = $i; $j < $tamanhoArray; $j++){
            if ($menorPalavra > $nArray[$j][$culturaHec]){
                $menorPalavra = $nArray[$j][$culturaHec];
                $posicao = $j;
            }
        }

        $intermediador = $nArray[$i];
        $nArray[$i] = $nArray[$posicao];
        $nArray[$posicao] = $intermediador;
    }

    return $nArray;
}

function usortHectares(array $nArray, $tamanhoArray){

    for ($i = 0; $i < $tamanhoArray; $i++){
            
        for ($i = 0; $i < $tamanhoArray; $i++){

            $maiorHc = $nArray[$i]['hectares'];
            $posicao = $i;

            for ($j = $i; $j < $tamanhoArray; $j++){
                if ($nArray[$i]['cultura'] === $nArray[$j]['cultura']){
                    if ($maiorHc < $nArray[$j]['hectares']){
                        $maiorHc = $nArray[$j]['hectares'];
                        $posicao = $j;
                    }
                }
            }


        $intermediador = $nArray[$i];
        $nArray[$i] = $nArray[$posicao];
        $nArray[$posicao] = $intermediador;
    }
    }

    return $nArray;
}

$arrayOrdenadoCultura = usortCultura($talhoes, $tamanho);

print_r(usortHectares($arrayOrdenadoCultura, $tamanho));
