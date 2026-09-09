<?php

namespace App;

class Placar{
    public $jogadores = [];

    public function cadastrarJogadores(){
        do {
            $qtdJogadores = readline("Deseja jogar com 1 ou 2 jogadores?: ");

            if ($qtdJogadores > 2 || $qtdJogadores < 1) {
                echo "Informe uma quantidade válida de jogadores! \n";
                continue;
            }

            for ($i = 0; $i < $qtdJogadores; $i++) { 
                $nome = readline("Informe seu nome: ");
                $this->jogadores[$nome] = [
                    "pontos" => 0,
                    "vidas" => 6 / $qtdJogadores
                ];
        }

        break;
    } while (true);
}

     //Função para definir vencedor

    public function resultadoPlacar(){
        $nomesJogadores = $this->getNomeJogadores();

        if (count($nomesJogadores) > 1){
            $pontos = [];

            foreach($this->jogadores as $nome => $dadosPlacar){
                $pontos[$nome] = $dadosPlacar["pontos"]; 
            }

            $maiorPontuacao = max($pontos);
            $vencedor = array_keys($pontos, $maiorPontuacao);

            if (count($vencedor) > 1) {
                return "O jogo empatou!\n";
            }

            return $vencedor[0] . " ganhou o jogo com $maiorPontuacao pontos!\n";
        } 
    
    return $this->getVidas($nomesJogadores[0]) > 0 
           ? "Você ganhou o jogo!\n"
           : "Você perdeu o jogo!\n";
    }

    //Funções para exibir valores
    public function getNomeJogadores(){
        return array_keys($this->jogadores);
    }

    public function getPontos(string $jogador){
        return $this->jogadores[$jogador]["pontos"];
    }

    public function getVidas(string $jogador){
        return $this->jogadores[$jogador]["vidas"];
    }

    //Funções para alterar o placar

    public function adicionarPontuacao(string $jogador){
        $this->jogadores[$jogador]["pontos"]++;
    }

    public function removerPontuacao(string $jogador){
        $this->jogadores[$jogador]["pontos"]--;
    }

    public function removerVida(string $jogador){
        $this->jogadores[$jogador]["vidas"]--;
    }

   
}