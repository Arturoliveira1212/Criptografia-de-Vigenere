<?php

$string = "intervalo";
$array = mb_str_split($string);

$comPosicao = [];
foreach ($array as $i => $letra) {
    $comPosicao[] = ['letra' => $letra, 'posicao' => $i];
}

// Para ordenar por letra mantendo a posição original:
usort($comPosicao, function($a, $b) {
    return strcmp($a['letra'], $b['letra']);
});

var_dump($comPosicao);