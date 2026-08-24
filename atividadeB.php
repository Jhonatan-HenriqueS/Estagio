<?php

$numbers = [
    "bolsonaro" => 10,
    "maça" =>  20,
    "mamão" => 30,
    "0" => 40,
    "50" => 50,
    "10" => 10,
    "20" => 20,
    "5" => 5,
    "12" => 12,
    "52" => 52,
    "76" => 76,
    "0" => 0.4,
    "2" => 2
 ];

//Passo 1: Criar a função meuInArray que verifica se o número do usuário está no Array

$whatNumber = readline("Verifique se seu número está no Array: ");

function meuInArray(array $nArray, $wNumber){
    foreach ($nArray as $v){
        if ($wNumber == $v) return true;
    }

    return false;
}

$conditionBool = meuInArray($numbers, $whatNumber);

if ($conditionBool)
    echo "Seu número está no Array\n";
else
    echo "Seu número não está no Array\n";

//Passo 2: Criar a função minhaBusca que retorna a posição do vetor, caso for encontrado. 
//BS: Faça a busca usando foreach

function minhaBusca(array $nArray, $wNumber){
    foreach ($nArray as $chave => $valor){
         if ($wNumber == $valor) return $chave;
    }
}

$findPosition = minhaBusca($numbers, $whatNumber);

if ($findPosition === null)
    var_dump($findPosition);
else
    echo "Seu valor está na posição $findPosition \n";


//Passo 3: Criar a função meuMaiorMenor que encontra o maior número e o menor do Array

function meuMaiorMenor(array $nArray){
    foreach ($nArray as $valor) {
        if (!$bigger){
            $bigger = $valor;
        }

        if (!$smiller) {
            $smiller = $valor;
        }

        if ($valor > $bigger){
            $bigger = $valor;
        }

        if ($valor < $smiller){
            $smiller = $valor;
        }
    }
    return [$bigger, $smiller];
}

[$myBigger, $mySmaller] = meuMaiorMenor($numbers);

echo "O maior número encontrado foi: $myBigger \n";
echo "O menor número encontrado foi: $mySmaller \n";