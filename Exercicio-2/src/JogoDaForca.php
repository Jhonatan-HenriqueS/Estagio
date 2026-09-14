<?php

namespace App;

class JogoDaForca{
    private array $dadosCSV;
    private array $categorias;
    private Placar $placar;
    private DadosCSV $dadosPalavras;
    private DadosCSV $dadosPlacar;

    public function __construct(Placar $placar, DadosCSV $dadosPalavras, DadosCSV $dadosPlacar)
    {
        $this->placar = $placar;
        $this->dadosPalavras = $dadosPalavras;
        $this->dadosPlacar = $dadosPlacar;

        $this->dadosCSV = $this->dadosPalavras->extrairDados();
        $this->categorias = array_values(array_unique(array_column($this->dadosCSV, 'categoria')));
    }

    public function iniciar()
    {
        $this->placar->cadastrarJogadores();
        echo $this->limpar();

        $palavras = $this->selecionarCategoria();
        echo $this->limpar();

        echo $this->jogarRodada($palavras);
    }

    public function adicionarPalavra()
    {
        $this->exibirCategorias();

        echo "\nSe não desejar nenhuma, cria a sua própria categoria! \n\n";

        $categoria = $this->placar->verificarValorNull("Informe uma categoria: ");
        $palavra = $this->placar->verificarValorNull("Informe uma palavra para sua categoria: ");

        $this->dadosPalavras->salvarCSV([uniqid(), $categoria, $palavra]);
        echo $this->limpar();

        echo "Palavra cadastrada com sucesso!";
    }

    public function exibirPlacar(){
        $placarMaiorMenor = $this->dadosPlacar->extrairDados();
        $i = 0;

        usort($placarMaiorMenor, function ($a, $b ) {
            return $b['pontos'] <=> $a['pontos'];
        });

        echo "\t+--------------------------------------+\n";
        foreach ($placarMaiorMenor as $placar) {
            $i++;
            echo "\t|" . str_pad($i, 4, " ", STR_PAD_BOTH) 
            . "-" 
            . str_pad($placar['jogador'], 20, " ", STR_PAD_BOTH) 
            . str_pad($placar['pontos'], 5, " ", STR_PAD_BOTH) 
            . " pontos | \n";
        }
        echo "\t+--------------------------------------+\n";
    }

    private function jogarRodada(array $palavras)
    {
        $partida = new EstadoPartida($palavras[array_rand($palavras)]['palavra']);
        $jogadores = $this->placar->getNomeJogadores();
        $vezJogador = 0;

        while (true) {
            $jogadorAtual = $jogadores[$vezJogador];
            $vidasRestantes = $this->placar->somarVidas($jogadorAtual);

            $this->exibirEstado($partida, $jogadores, $vidasRestantes);
            echo "\n";


            $letra = $this->receberLetra($jogadorAtual);

            if ($letra === '0') {
                break;
            }

            $this->verificarLetra($partida, $jogadorAtual, $letra);

            if ($partida->verificarPalavraDescoberta() || $vidasRestantes === 0) {
                break;
            }

            $vezJogador = $this->irProProximoJogador($jogadores, $vezJogador);


            echo $this->limpar();

        }

        $this->guardarPlacar($jogadores);

        echo $this->limpar();

        return "\nFinalizado!\nA palavra era: {$partida->getPalavra()}\n" . $this->placar->resultadoPlacar();
    }

    private function verificarLetra(EstadoPartida $partida, $jogador, $letra)
    {
        if ($partida->verficarLetra($letra)) {
            $this->placar->adicionarPontuacao($jogador);
            return;
        }

        if ($partida->verficarRepeticaoErros($letra) || $partida->verificarRepeticaoAcertos($letra)) {
            return;
        }

        $partida->setLetra($letra);
        $this->placar->removerPontuacao($jogador);
        $this->placar->removerVida($jogador);

        echo "\n Letra inválida, -1 vida \n $jogador possui {$this->placar->getVidas($jogador)} vidas restantes!\n";
    }

    private function exibirEstado(EstadoPartida $partida, $jogadores, $vidasRestantes)
    {
        echo $partida->desenharForca($vidasRestantes) . $partida->getProgressoDaPalavra() . "\n";

        foreach ($jogadores as $jogador) {
            echo "\n$jogador está com: {$this->placar->getPontos($jogador)} pontos e {$this->placar->getVidas($jogador)} vidas";
        }

        echo ($partida->getLetrasUsadas() === '')
            ? "\n\nNenhum erro até o momento \n"
            : "\n\nLetras já usadas: {$partida->getLetrasUsadas()} \n";
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
        echo "\t+-------------------------+\n";
        foreach ($this->categorias as $i => $categoria) {
            $i++;
            echo "\t| $i -" . str_pad($categoria, 20, " ", STR_PAD_BOTH) . " | \n";
        }
        echo "\t+-------------------------+\n";
    }


    private function selecionarCategoria()
    {
        $this->exibirCategorias();

        do {
            $categoria = trim(readline("Selecione uma opção: "));

            if ($categoria < 1 || $categoria > count($this->categorias)){
                echo "\nInforme um número valido!\n";
                continue;
            }

            $palavrasDaCategoria = array_values(array_filter($this->dadosCSV, fn($linha) => $linha['categoria'] === $this->categorias[$categoria - 1]));
        } while (empty($palavrasDaCategoria));

        return $palavrasDaCategoria;

        // $this->exibirCategorias();

        // do {
        //     $categoria = strtolower(trim(readline("Informe uma categoria: ")));
        //     $palavrasDaCategoria = array_values(array_filter($this->dadosCSV, fn($linha) => $linha['categoria'] === $categoria));
        // } while (empty($palavrasDaCategoria));

        // return $palavrasDaCategoria;
    }

    

    private function receberLetra($jogador)
    {
        do {
            $letra = strtolower(readline("É a vez de: $jogador, informe uma letra ou 0 para encerrar: "));

        } while ((strlen($letra) !== 1 || !ctype_lower($letra)) && $letra !== "0");

        return $letra;
    }

    public function guardarPlacar(array $jogadores)
    {
        foreach ($jogadores as $jogador) {
            $pontosNovos = $this->placar->getPontos($jogador);

            if ($this->jogadorExiste($jogador)) {
                
                $pontosTotais = $this->dadosPlacar->buscarPontos($jogador) + $pontosNovos;

                $this->dadosPlacar->atualizarPontos(
                    $jogador,
                    $pontosTotais
                );
            } else {
                $this->dadosPlacar->salvarCSV([
                    $jogador,
                    $pontosNovos
                ]);
            }
        }
}

    private function jogadorExiste(string $jogador)
    {
        $dados = $this->dadosPlacar->extrairDados();

        $jogadores = array_column($dados, 'jogador');

        return in_array($jogador, $jogadores);
    }
    

    public function limpar()
    {
        return "\033[2J\033[;H";
    }
}