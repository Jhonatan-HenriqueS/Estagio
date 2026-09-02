<?php

$numbers = [10, 20, 30, 40, 10, 50, 60, 30, 20, 10, 40];

//Passo 1: Criar uma função meuArrayUnique que remove duplicados

function meuArrayUnique(array $nArray){
   $newArray = [];

   foreach ($nArray as $value){
   $jaExiste = false;

    foreach ($newArray as $v){
        if ($v == $value){
            $jaExiste = true;
            break;
        }
    }

    if (!$jaExiste)
        $newArray[] = $value;
   }
    return $newArray;
}

var_dump(meuArrayUnique($numbers)); 

//Passo 2: Criar uma função contarOcorrencias que verifica quantas vezes cada elemento se repetiu

function contarOcorrencias(array $nArray){
   $newArray = [];

   foreach (meuArrayUnique($nArray) as $value){
    $contador = 0;
    
    foreach ($nArray as $v){
        if ($value == $v){
            $contador++;
        }
    }

    $newArray[] = [$value, $contador];
   }

   return $newArray;
}

foreach (contarOcorrencias($numbers) as [$a, $b]) {
    echo "O número $a apareceu $b vezes\n";
}

