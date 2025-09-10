<?php

namespace Criptografia;

class Criptografador {
    private string $senha;
    const LETRA_MORTA = '#';

    public function __construct(string $senha) {
        $this->senha = $senha;
    }

    public function criptografar(string $texto) {
        $matrizModular = $this->criarMatrizModular($texto);
        $matrizConsulta = $this->criarMatrizDeConsulta();

        $senhaEmArrayOrdenado = $this->obterSenhaEmArrayOrdenado();
        $artur = '';
        foreach ($senhaEmArrayOrdenado as $elemento) {
            $tamanhoSenha = mb_strlen($this->senha);
            $tamanhoTexto = mb_strlen($texto);
            $quantidadeLinhasMatriz = ceil($tamanhoTexto / $tamanhoSenha);
            for ($i = 0; $i < $quantidadeLinhasMatriz; $i++) {
                $artur .= $matrizModular[$i][$elemento['posicao']];
            }
        }

        return $artur;
    }

    public function criarMatrizModular(string $texto) {
        $tamanhoSenha = mb_strlen($this->senha);
        $tamanhoTexto = mb_strlen($texto);

        $quantidadeLinhasMatriz = ceil($tamanhoTexto / $tamanhoSenha);
        $quantidadeColunasMatriz = $tamanhoSenha;

        $matriz = [];
        for ($i = 0; $i < $quantidadeLinhasMatriz; $i++) {
            $matriz[$i] = [];
            for ($j = 0; $j < $quantidadeColunasMatriz; $j++) {
                $matriz[$i][$j] = $texto[$i * $quantidadeColunasMatriz + $j] ?? self::LETRA_MORTA;
            }
        }

        return $matriz;
    }

    public function criarMatrizDeConsulta() {
        $alfabeto = range('A', 'Z');
        array_push($alfabeto, ' ', self::LETRA_MORTA);

        $tamanhoAlfabeto = count($alfabeto);

        $matrizConsulta = [];
        for ($i = 0; $i < $tamanhoAlfabeto; $i++) {
            $matrizConsulta[$i] = [];
            for ($j = 0; $j < $tamanhoAlfabeto; $j++) {
                $matrizConsulta[$i][$j] = $alfabeto[($i + $j) % $tamanhoAlfabeto];
            }
        }

        return $matrizConsulta;
    }

    private function obterSenhaEmArrayOrdenado() {
        $senhaEmArray = mb_str_split($this->senha);

        $senhaEmArrayComPosicao = [];
        foreach ($senhaEmArray as $i => $letra) {
            $senhaEmArrayComPosicao[] = ['letra' => $letra, 'posicao' => $i];
        }

        // Para ordenar por letra mantendo a posição original:
        usort($senhaEmArrayComPosicao, function ($a, $b) {
            return strcmp($a['letra'], $b['letra']);
        });

        return $senhaEmArrayComPosicao;
    }
    public function descriptografar(string $texto) {

    }
}