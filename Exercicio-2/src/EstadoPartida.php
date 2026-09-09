<?php

namespace App;

class EstadoPartida
{
    private string $palavra;
    private array $sublinhados = [];
    private array $letrasUsadas = [];

    //Constrói a classe com o array sublinhado preenchido

    public function __construct(string $palavra)
    {
        $this->palavra = $palavra;

        foreach (str_split($palavra) as $indice => $letra) {
            $this->sublinhados[$indice] = ($letra === '-') ? ' - ' : '_';
        }
    }

    //Verifica se a letra existe

    public function verficarLetra(string $letra){
        $acertou = false;

        foreach (str_split($this->palavra) as $indice => $letraPalavra) {
            if ($letraPalavra === '-') {
                continue;
            }

            if ($letra === $letraPalavra) {
                $this->sublinhados[$indice] = $letra;
                $acertou = true;
            }
        }

        return $acertou;
    }

    //Verifica se a palavra foi descoberta
    public function verificarPalavraDescoberta()
    {
        return $this->getProgressoDaPalavra() == $this->palavra;
    }

    //Verifica se a letra não existente já foi informada
    public function verficarRepeticao(string $letra)
    {
        return in_array($letra, $this->letrasUsadas);
    }

    //Insere a letra no array de letras usadas
    public function setLetra(string $letra)
    {
        $this->letrasUsadas[] = $letra;
    }


    //Funções para exibir valores
    public function getPalavra()
    {
        return $this->palavra;
    }

    public function getProgressoDaPalavra()
    {
        return implode('', $this->sublinhados);
    }

    public function getLetrasUsadas()
    {
        return implode(', ', $this->letrasUsadas);
    }
   
}