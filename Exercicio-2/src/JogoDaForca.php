<?php

namespace App;

class JogoDaForca{
    private array $todosDados;
    private array $categorias;
    private Placar $placar;
    private DadosPalavras $dadosPalavras;

    public function __construct(Placar $placar, DadosPalavras $dadosPalavras)
    {
        $this->placar = $placar;
        $this->dadosPalavras = $dadosPalavras;

        $this->todosDados = $this->dadosPalavras->extrairDados();
        $this->categorias = array_values(array_unique(array_column($this->todosDados, 'categoria')));
    }

    public function iniciar()
    {
        $this->placar->cadastrarJogadores();

        $palavras = $this->selecionarCategoria();

        echo $this->jogarRodada($palavras);
    }

    public function adicionarPalavra()
    {
        $this->exibirCategorias();

        $categoria = strtolower(trim(readline("Informe a categoria da nova palavra: ")));
        $palavra = strtolower(trim(readline("Informe a palavra que deseja adicionar: ")));

        $this->dadosPalavras->salvarPalavraCSV([uniqid(), $categoria, $palavra]);
    }

    private function jogarRodada(array $palavras)
    {
        $partida = new EstadoPartida($palavras[array_rand($palavras)]['palavra']);
        $jogadores = $this->placar->getNomeJogadores();
        $vezJogador = 0;
        $fimDeJogo = 0;

        while (true) {
            $jogadorAtual = $jogadores[$vezJogador];

            $this->exibirEstado($partida, $jogadores);

            $letra = $this->receberLetra($jogadorAtual);

            if ($letra === '0') {
                break;
            }

            $this->verificarLetra($partida, $jogadorAtual, $letra);
            $fimDeJogo = $this->placar->getVidas($jogadores[0]) + $this->placar->getVidas($jogadores[1]); 

            if ($partida->palavraDescoberta() || $fimDeJogo === 0) {
                break;
            }

            $vezJogador = $this->proximoJogador($jogadores, $vezJogador);

            echo $this->limpar();
        }

        return "\nFinalizado!\nA palavra era: {$partida->palavra()}\n" . $this->placar->resultadoPlacar();
    }

    private function verificarLetra(EstadoPartida $partida, $jogador, $letra)
    {
        if ($partida->verficarLetra($letra)) {
            $this->placar->adicionarPontuacao($jogador);
            return;
        }

        if ($partida->jaTentou($letra)) {
            return;
        }

        $partida->registrarTentativa($letra);
        $this->placar->removerPontuacao($jogador);
        $this->placar->removerVida($jogador);

        echo "\n Letra inválida, -1 vida \n $jogador possui {$this->placar->getVidas($jogador)} vidas restantes!\n";
    }

    private function exibirEstado(EstadoPartida $partida, $jogadores)
    {
        echo $partida->progresso();

        foreach ($jogadores as $jogador) {
            echo "\n\n$jogador está com: {$this->placar->getPontos($jogador)} pontos";
            echo "\n$jogador está com: {$this->placar->getVidas($jogador)} vidas\n";
        }

        echo ($partida->letrasUsadas() === '')
            ? "\nNenhum erro até o momento \n"
            : "\nLetras já usadas: {$partida->letrasUsadas()} \n";
    }
/* 
    private function eliminados(array $jogadores)
    {
        foreach ($jogadores as $jogador) {
            if ($this->placar->getVidas($jogador) > 0) {
                return false;
            }
        }

        return true;
    } */

    private function proximoJogador(array $jogadores, $vezJogador)
    {
        if (count($jogadores) < 2) {
            return 0;
        }

        $proximo = $vezJogador ^ 1;

        while ($this->placar->getVidas($jogadores[$proximo]) === 0) {
            echo "\n{$jogadores[$proximo]} está eliminado! \n";
            $proximo ^= 1;
        }

        return $proximo;
    }

    private function exibirCategorias()
    {
        echo "\n\t|-------------------------------------------|\n";

        foreach ($this->categorias as $categoria) {
            echo "\t|         \t $categoria \t            |\n";
        }

        echo "\t|-------------------------------------------|\n";
    }

    private function selecionarCategoria()
    {
        $this->exibirCategorias();

        do {
            $categoria = strtolower(trim(readline("Informe uma categoria: ")));
            $palavrasDaCategoria = array_values(array_filter($this->todosDados, fn($linha) => $linha['categoria'] === $categoria));
        } while (empty($palavrasDaCategoria));

        return $palavrasDaCategoria;
    }

    private function receberLetra($jogador)
    {
        do {
            $letra = strtolower(readline("É a vez de: $jogador, informe uma letra ou 0 para encerrar: "));

            if ($letra === '0') {
                return '0';
            }
        } while (strlen($letra) !== 1 || !ctype_lower($letra));

        return $letra;
    }

    public function limpar()
    {
        return "\033[2J\033[;H";
    }
}