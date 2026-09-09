<?php

namespace App;

class JogoDaForca{
    private array $dadosCSV;
    private array $categorias;
    private Placar $placar;
    private DadosCSV $dadosPalavras;

    public function __construct(Placar $placar, DadosCSV $dadosPalavras)
    {
        $this->placar = $placar;
        $this->dadosPalavras = $dadosPalavras;

        $this->dadosCSV = $this->dadosPalavras->extrairDados();
        $this->categorias = array_values(array_unique(array_column($this->dadosCSV, 'categoria')));
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

        echo "Se não desejar nenhuma, cria a sua própria categoria!";

        $categoria = $this->placar->verificarValorNull("Informe uma categoria: ");

        $palavra = $this->placar->verificarValorNull("Informe uma palavra para sua categoria: ");

        $this->dadosPalavras->salvarPalavraCSV([uniqid(), $categoria, $palavra]);
    }

    private function jogarRodada(array $palavras)
    {
        $partida = new EstadoPartida($palavras[array_rand($palavras)]['palavra']);
        $jogadores = $this->placar->getNomeJogadores();
        $vezJogador = 0;

        while (true) {
            $jogadorAtual = $jogadores[$vezJogador];

            $this->exibirEstado($partida, $jogadores);

            $letra = $this->receberLetra($jogadorAtual);

            if ($letra === '0') {
                break;
            }

            $this->verificarLetra($partida, $jogadorAtual, $letra);

            if ($partida->verificarPalavraDescoberta() || $this->placar->somarVidas($jogadorAtual) === 0) {
                break;
            }

            $vezJogador = $this->irProProximoJogador($jogadores, $vezJogador);

            echo $this->limpar();

        }

        return "\nFinalizado!\nA palavra era: {$partida->getPalavra()}\n" . $this->placar->resultadoPlacar();
    }

    private function verificarLetra(EstadoPartida $partida, $jogador, $letra)
    {
        if ($partida->verficarLetra($letra)) {
            $this->placar->adicionarPontuacao($jogador);
            return;
        }

        if ($partida->verficarRepeticao($letra)) {
            return;
        }

        $partida->setLetra($letra);
        $this->placar->removerPontuacao($jogador);
        $this->placar->removerVida($jogador);

        echo "\n Letra inválida, -1 vida \n $jogador possui {$this->placar->getVidas($jogador)} vidas restantes!\n";
    }

    private function exibirEstado(EstadoPartida $partida, $jogadores)
    {
        echo $partida->getProgressoDaPalavra();

        foreach ($jogadores as $jogador) {
            echo "\n\n$jogador está com: {$this->placar->getPontos($jogador)} pontos e {$this->placar->getVidas($jogador)} vidas\n";
        }

        echo ($partida->getLetrasUsadas() === '')
            ? "\nNenhum erro até o momento \n"
            : "\nLetras já usadas: {$partida->getLetrasUsadas()} \n";
    }

    private function irProProximoJogador(array $jogadores, $vezJogador)
    {
        $totalJogadores = count($jogadores);

        if ($totalJogadores < 2) {
            return 0;
        }

        $proximo = $vezJogador ^ 1;
        $i = 0;

        while ($this->placar->getVidas($jogadores[$proximo]) === 0) {
            echo "\n{$jogadores[$proximo]} está eliminado! \n";
            $proximo ^= 1;
            $i++;

            if ($i == $totalJogadores) {
                break;
            }
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
            $palavrasDaCategoria = array_values(array_filter($this->dadosCSV, fn($linha) => $linha['categoria'] === $categoria));
        } while (empty($palavrasDaCategoria));

        return $palavrasDaCategoria;
    }

    private function receberLetra($jogador)
    {
        do {
            $letra = strtolower(readline("É a vez de: $jogador, informe uma letra ou 0 para encerrar: "));

        } while ((strlen($letra) !== 1 || !ctype_lower($letra)) && $letra !== "0");

        return $letra;
    }
    

    public function limpar()
    {
        return "\033[2J\033[;H";
    }
}