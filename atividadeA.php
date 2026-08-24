<?php

$numbers = [10, 20, 30, 60];

//Passo 1: Criar a função meuCount para conta quantos números existem no meu array

function meuCount(array $nArray){

    $counter = 0;

    foreach ($nArray as $v){
        $counter += 1;
    }

    return $counter;
    
}

$amount = meuCount($numbers);

//Passo 2: Criar função minhaSoma que retorna a soma

function minhaSoma(array $nArray){

    $sum = 0;

   foreach ($nArray as $v)
    {
        $sum += $v;
    }
    
    return $sum;
}

$sumArray = minhaSoma($numbers);

//Passo 3: Criar função minhaMedia que retorna a média do Array



function minhaMedia(array $nArray){

    $counter = 0;
    $sum = 0;

    foreach ($nArray as $v){
        $counter += 1;
        $sum += $v;
    }

    $result = $sum / $counter;

    return $result;
}

$operation = minhaMedia($numbers);

//Passo final: Exibir todos os passos

echo "Quantidade de elementos no Array: $amount \n";
echo "Soma de todos os elementos do Array: $sumArray \n";
echo "Média dos elementos do Array: $operation \n";


