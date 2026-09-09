<?php

namespace App;

class EstadoPartida
{
    private string $palavra;
    private array $sublinhados = [];
    private array $letrasUsadas = [];

    public function __construct(string $palavra)
    {
        $this->palavra = $palavra;

        foreach (str_split($palavra) as $indice => $letra) {
            $this->sublinhados[$indice] = ($letra === '-') ? ' - ' : '_';
        }
    }

    public function palavra()
    {
        return $this->palavra;
    }

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

    public function jaTentou(string $letra)
    {
        return in_array($letra, $this->letrasUsadas);
    }

    public function registrarTentativa(string $letra)
    {
        $this->letrasUsadas[] = $letra;
    }

    public function palavraDescoberta()
    {
        return $this->progresso() == $this->palavra;
    }

    public function progresso()
    {
        return implode('', $this->sublinhados);
    }

    public function letrasUsadas()
    {
        return implode(', ', $this->letrasUsadas);
    }
}