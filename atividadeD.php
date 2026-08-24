<?php

$numbers = [17, 14, 7, 10, 15, 10, 16, 10, 16, 13, 2, 6, 8, 14, 18, 14, 15, 13, 11, 7, 4, 9, 19, 15, 19, 12, 7, 19, 18, 5];

//Passo 1: criar uma função que coloca o array em ordem decrescente ou decrescente com o método bubble Sort


echo "1 - Descrescente \n 2 - Crescente \n";
$escolha = readline("Informe como quer ordenar seu Array: ");

function bubbleSort(array $nArray, $qualMetodo){
    $tamanho = 0;
    $comparacao = 0;

    foreach ($nArray as $valor){
        $tamanho++;
    }

    for ($i = 0; $i < $tamanho - 1; $i++) {

        for ($j = 0; $j < $tamanho - $i - 1; $j++) {
            $comparacao++;

            if ($qualMetodo == 1){
                if ($nArray[$j + 1] > $nArray[$j]) {
                    $intermediador = $nArray[$j];
                    $nArray[$j] = $nArray[$j + 1];
                    $nArray[$j + 1] = $intermediador;
                }
            } else {
                if ($nArray[$j + 1] < $nArray[$j]) {
                    $intermediador = $nArray[$j];
                    $nArray[$j] = $nArray[$j + 1];
                    $nArray[$j + 1] = $intermediador;
                }
            }

        }
    }

    return [$nArray, $comparacao];
}

[$arrayBub, $comparacoesBub] = bubbleSort($numbers, $escolha);

var_dump($arrayBub);


//Passo 2: criar uma função que coloca o array em ordem decrescente ou decrescente com o método selection Sort

function selectionSort(array $nArray, $qualMetodo){
   $tamanho = 0;
   $comparacao = 0;

   foreach ($nArray as $valor){
        $tamanho++;
   }

   for ($i = 0; $i < $tamanho; $i++){

        $maiorMenor = $nArray[$i];
        $posicaoEncontrada = $i; 

        for ($j = $i; $j < $tamanho; $j++){

            $comparacao++;

            if ($qualMetodo == 1){
                if ($maiorMenor < $nArray[$j]){
                    $maiorMenor = $nArray[$j];
                    $posicaoEncontrada = $j;
            }     
            } else {
                if ($maiorMenor > $nArray[$j]){
                    $maiorMenor = $nArray[$j];
                    $posicaoEncontrada = $j;
            }     
            }  
        }

        $intermediador = $nArray[$i];
        $nArray[$i] = $maiorMenor;
        $nArray[$posicaoEncontrada] = $intermediador;
    }

    return [$nArray, $comparacao];

}

[$arraySel, $comparacoesSel] = selectionSort($numbers, $escolha);

var_dump($arraySel);

echo "\n O método Bubble Sort obteve $comparacoesBub comparações. \n\n";
echo "\n\nO método Selection Sort obteve $comparacoesSel comparações.\n\n";
