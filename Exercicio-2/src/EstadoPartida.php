<?php

namespace App;

class EstadoPartida
{
    private string $palavra;
    private array $sublinhados = [];
    private array $letrasUsadas = [];

    //Constrói a classe com o array sublinhado preenchido

    public function __construct($palavra)
    {
        $this->palavra = $palavra;

        foreach (str_split($palavra) as $indice => $letra) {
            $this->sublinhados[$indice] = ($letra === '-') ? ' - ' : '_';
        }
    }

    //Verifica se a letra existe

    public function verficarLetra($letra){
        $acertou = false;

        if ($this->verificarRepeticaoAcertos($letra)){
            return;
        }

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

    function desenharForca($vidasRestantes){
        $forca = [
            6 => "
             ______        
             |    |
             |    |
             |    
             |
             |
             |       
        _____|_____ ",
            5 => "
             ______        
             |    |
             |    |
             |    O
             |
             |
             |       
        _____|_____ ",
            4 => "
             ______        
             |    |
             |    |
             |    O
             |    |
             |
             |       
        _____|_____ ",
           3 => "
             ______        
             |    |
             |    |
             |   \O
             |    |
             |   
             |       
        _____|_____ ",
            2 => "
             ______        
             |    |
             |    |
             |   \O/
             |    |
             |   
             |       
        _____|_____ ",
             1 => "
             ______        
             |    |
             |    |
             |   \O/
             |    |
             |   /
             |       
        _____|_____ ",
             0 => "
             ______        
             |    |
             |    |
             |   \O/
             |    |
             |   / \
             |       
        _____|_____ ",
        ];

        
        return $forca[$vidasRestantes];
    }

    //Verifica se a palavra foi descoberta
    public function verificarPalavraDescoberta()
    {
        return $this->getProgressoDaPalavra() == $this->palavra;
    }

    //Verifica se a letra não existente já foi informada
    public function verficarRepeticaoErros($letra)
    {
        return in_array($letra, $this->letrasUsadas);
    }

    public function verificarRepeticaoAcertos($letra){
        return in_array($letra, $this->sublinhados);
    }

    //Insere a letra no array de letras usadas
    public function setLetra($letra)
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