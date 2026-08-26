<<<<<<< HEAD:atividadeD.php
Atividade D: <?php

$numbers = [17, 14, 7, 10, 15, 10, 16, 10, 16, 13, 2, 6, 8, 14, 18, 14, 15, 13, 11, 7, 4, 9, 19, 15, 19, 12, 7, 19, 18, 5];

//Passo 1: criar uma função que coloca o array em ordem decrescente ou decrescente com o método bubble Sort



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
               } else{
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

do{
    echo "
          1 - Descrescente
          2 - Crescente
          0 - Sair \n";

    $escolha = readline("Informe como quer ordenar seu Array: ");

    switch ($escolha){
        case 1:
        case 2: 
                [$arraySel, $comparacoesSel] = selectionSort($numbers, $escolha);
                [$arrayBub, $comparacoesBub] = bubbleSort($numbers, $escolha);

                print_r($arrayBub);
                print_r($arraySel);

                echo "\n O método Bubble Sort obteve $comparacoesBub comparações. \n\n";
                echo "O método Selection Sort obteve $comparacoesSel comparações.\n\n";
            break;

        case 0: 
                echo "Fim!";
            break;
        
        default:
            echo "Opção inválida, tente novamente!";
        break;

    }
=======
<?php

$numbers = [17, 14, 7, 10, 15, 10, 16, 10, 16, 13, 2, 6, 8, 14, 18, 14, 15, 13, 11, 7, 4, 9, 19, 15, 19, 12, 7, 19, 18, 5];

//Passo 1: criar uma função que coloca o array em ordem decrescente ou decrescente com o método bubble Sort



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
               } else{
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

do{
    echo "
          1 - Descrescente
          2 - Crescente
          0 - Sair \n";

    $escolha = readline("Informe como quer ordenar seu Array: ");

    switch ($escolha){
        case 1:
        case 2: 
                [$arraySel, $comparacoesSel] = selectionSort($numbers, $escolha);
                [$arrayBub, $comparacoesBub] = bubbleSort($numbers, $escolha);

                print_r($arrayBub);
                print_r($arraySel);

                echo "\n O método Bubble Sort obteve $comparacoesBub comparações. \n\n";
                echo "O método Selection Sort obteve $comparacoesSel comparações.\n\n";
            break;

        case 0: 
                echo "Fim!";
            break;
        
        default:
            echo "Opção inválida, tente novamente!";
        break;

    }
>>>>>>> bcf7799 (feat: Ex-1 FILE):Exercicio-1/atividadeD.php
}while($escolha != 0);