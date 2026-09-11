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

                $nome = $this->verificarValorNull("Digite seu nome: ");

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
        $nomeJogadores = $this->getNomeJogadores();

        if (count($nomeJogadores) > 1){
            $pontos = [];

            foreach($this->jogadores as $nome => $dadosPlacar){
                $pontos[$nome] = $dadosPlacar["pontos"]; 
            }

            $maiorPontuacao = max($pontos);
            $vencedor = array_keys($pontos, $maiorPontuacao);

            if (count($vencedor) > 1) {
                return "\nO jogo empatou!\n";
            }

            return "\n{$vencedor[0]} ganhou o jogo com $maiorPontuacao pontos!\n";
        } 
    
        return $this->getVidas($nomeJogadores[0]) > 0 
            ? "\nVocê ganhou o jogo!\n"
            : "\nVocê perdeu o jogo!\n";
    }

    //Somar vidas
     public function somarVidas(string $jogador){
        $nomeJogadores = $this->getNomeJogadores();
        
        if(count($nomeJogadores) > 1){
            $somarVida = 0;

            foreach ($nomeJogadores as $nome){
                $somarVida += $this->jogadores[$nome]["vidas"];
            }

            return $somarVida;
        }

        return $this->getVidas($jogador);

    }

    public function verificarValorNull($mensagem){
         do{
            $valor = strtolower(trim(readline($mensagem)));

            if($valor !== '' || ctype_lower($valor)){
                return $valor;
            }

            echo "Digite alguma palavra! \n";
        }while(true);
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
        $this->jogadores[$jogador]["pontos"] += 2;
    }

    public function removerPontuacao(string $jogador){
        $this->jogadores[$jogador]["pontos"]--;
    }

    public function removerVida(string $jogador){
        $this->jogadores[$jogador]["vidas"]--;
    }
   
}