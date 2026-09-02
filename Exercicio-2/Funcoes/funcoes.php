<?php

//Lógica do jogo da forca

function exibirVidas(array $dadosCSV, array $placar){

    $palavraSortida = $dadosCSV[array_rand($dadosCSV)]['palavra'];
    $letraDigitada = "";

    $existe = "false";
    $letrasDigitadas = "";
    $sublinhados = [];

    $jogadores = array_keys($placar);
    $totalJodagores = count($jogadores);
    $vezJogador = 1;

        do{
            // Array é transformado em palavra para realizar processamento
            foreach (str_split($palavraSortida) as $key => $letra){

                // Verifica se a posição não existe
                if (!isset($sublinhados[$key])){
                    $sublinhados[$key] = "_";
                }

                // Verifica se há hifen
                if ($letra === "-"){
                    $sublinhados[$key] = " - ";
                    continue;
                }

                // Verifica se a letra existe 
                if ($letraDigitada == $letra){
                    $sublinhados[$key] = "$letra";
                    $placar[$jogadores[$vezJogador]]["pontos"]++;   
                    $existe = true;
                }
                         
            }

            // Transforma o Array em uma palavra
            $palavraImplode = implode('', $sublinhados);
            $vidasJogador = $placar[$jogadores[$vezJogador]]["vidas"];

            // Verifica existência da letra e se já foi usada
            if (!$existe && !str_contains($letrasDigitadas, $letraDigitada)){
                $letrasDigitadas .= "$letraDigitada, ";
                $placar[$jogadores[$vezJogador]]["vidas"]--;
                $placar[$jogadores[$vezJogador]]["pontos"]--;

                echo "\n Letra inválida, -1 vida \n {$jogadores[$vezJogador]} possui $vidasJogador vidas restantes!\n";       
            }

            $tentativas = ($totalJodagores === 2) 
            ? array_sum(array_column($placar, "vidas"))
            : $placar[$jogadores[$vezJogador]]["vidas"];


            if ($palavraImplode == $palavraSortida || $tentativas === 0){
                echo resultadoPlacar($placar, $jogadores);
                break;
            }

            echo $palavraImplode;

            foreach ($placar as $jogador => $placarJogador) {
                echo "\nO Jogador $jogador está com: {$placarJogador["pontos"]} pontos";
            }  

            echo ($letrasDigitadas == "") ? "\nNenhum erro até o momento \n" : "\nLetras já usadas: $letrasDigitadas \n";

            $vezJogador = ($totalJodagores === 2) ? $vezJogador ^= 1 : 0; 
            $existe = false;

            while ($placar[$jogadores[$vezJogador]]["vidas"] === 0){
                echo "\n{$jogadores[$vezJogador]} está eliminado! \n";
                $vezJogador ^= 1;
            }
              
            $letraDigitada = verificarLetra($jogadores[$vezJogador]);

            echo limpar();

        } while ($letraDigitada != "0");

    return $palavraSortida;
}

function selecionarCategoria(array $dadosCSV){
    $categorias = array_unique(array_column($dadosCSV, 'categoria'));

    exibirCategorias($categorias);

    do{
        $categoria = strtolower(readline("Informe uma categoria: "));
        $palavrasDaCategoria = array_filter($dadosCSV, fn($cat) => $cat['categoria'] == strtolower($categoria));

    }while (!isset($palavrasDaCategoria));

    return $palavrasDaCategoria;
}

function resultadoPlacar (array $placar, array $jogadores){ //refatorar com foreach
    if (count($jogadores) > 1){
        $jogadorVerncedor = [];

        foreach ($placar as $chave => $valor){
            
        }
    } 

    if ($placar[$jogadores[0]]["vidas"] > 0) return "Você ganhou o jogo!\n";
    
    return "Você perdeu o jogo";

}

/*$pontosJogador1 = $placar[$jogadores[0]]["pontos"];
        $pontosJogador2 = $placar[$jogadores[1]]["pontos"];

        if ($pontosJogador1 > $pontosJogador2) return "$jogadores[0] ganhou o jogo\n";
        
        if ($pontosJogador1 < $pontosJogador2) return "$jogadores[1] ganhou o jogo\n";

        return "O jogo empatou!\n";
}*/

function exibirCategorias(array $categorias){

    echo "\n\t|-------------------------------------------|\n";
    
    foreach ($categorias as $categoria){
        echo "\t|         \t $categoria \t            |\n";
    }

    echo "\t|-------------------------------------------|\n";
}

// Valida a letra informada

function verificarLetra(string $jogador){
    do{
        $letra = strtolower(readline("É a vez de: $jogador, informe uma letra ou 0 para encerrar: "));

        if ($letra === "0") return "0";

    } while(strlen($letra) != 1 || !ctype_lower($letra)); // Verifica se é letra; Verifica se é 1 caractere

    return $letra;
}

// Valida a categoria e a palavra 

function criarPalavra(array $dadosCSV){
    $categoria = selecionarCategoria($dadosCSV);

    $palavra = strtolower(readline("Informa a palavra que deseja adicionar: "));

    return [
        'id' => uniqid(),
        'categoria' => $categoria,
        'palavra' => $palavra
    ];
}

function cadastrarJogadores(){
    do {
        $qtdJogadores = readline("Deseja jogar com 1 ou 2 jogadores?: ");
        $jogadores = [];

        if ($qtdJogadores > 2 || $qtdJogadores < 1) {
            echo "Informe uma quantidade válida de jogadores! \n";
            continue;
        }

        for ($i = 0; $i < $qtdJogadores; $i++) { 
            $nome = readline("Informe seu nome: ");
            $jogadores[$nome] = [
                "pontos" => 0,
                "vidas" => 6 / $qtdJogadores
            ];
        }
        
        return $jogadores;
    } while (true);
}

function limpar(){
    return "\033[2J\033[;H";
}

/**
 * Funções de leitura e escrita do CSV
 */

function extrairDados(){
    $dadosExtraidos = [];

    if(($handle = fopen("Lib/data.csv", "r"))){
        $cabecalho = fgetcsv($handle, 0, ";");

        while (($fields =  fgetcsv($handle, 0, ";"))) {

        $dadosExtraidos[] = array_combine($cabecalho, $fields); 
    }

        fclose($handle);      
    } else {
         die("O diretório não existe!");
    }

    return $dadosExtraidos;
}

function salvarPalavraCSV(array $nArray){

    if(($handle = fopen("Lib/data.csv", "a"))){

        fputcsv($handle, $nArray, ";");

        fclose($handle);
    }
}