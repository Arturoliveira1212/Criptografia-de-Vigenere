<?php

require __DIR__ . '/vendor/autoload.php';

use Criptografia\Criptografador;

$texto = readline('Forneça o texto a ser criptografado: ');
$senha = readline('Forneça a senha para a criptografia: ');


$criptografador = new Criptografador($senha);
$matriz = $criptografador->criptografar($texto);
var_dump($matriz);
die;

exibirMatriz($matriz);

function exibirMatriz(array $matriz): void {
        foreach ($matriz as $linha) {
            foreach ($linha as $elemento) {
                echo ($elemento !== null ? $elemento : ' ') . "\t";
            }
            echo PHP_EOL;
        }
    }
// echo $criptografiado;