<?php

function meuShuffle(array $array): array {
    $n = 0;
    foreach ($array as $v) {
        $n++;
    }

    for ($i = $n - 1; $i > 0; $i--) {
        $j = mt_rand(0, $i);
        $temp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $temp;
    }

    return $array;
}

$original = ['A', 'B', 'C'];
$totalRodadas = 60000;
$contagem = [];

for ($k = 0; $k < $totalRodadas; $k++) {
    $resultado = meuShuffle($original);

    $chave = "";
    foreach ($resultado as $letra) {
        $chave = $chave . $letra;
    }

    if (!isset($contagem[$chave])) {
        $contagem[$chave] = 0;
    }
    $contagem[$chave]++;
}

foreach ($contagem as $ordem => $vezes) {
    echo "$ordem: $vezes vezes\n";
}