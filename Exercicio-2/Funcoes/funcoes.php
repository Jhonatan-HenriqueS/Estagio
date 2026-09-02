<?php

//Lógica do jogo da forca

function exibirVidas(array $nArray, array $placar){

    $palavraSortida = $nArray[array_rand($nArray)]['palavra'];
    $letraDigitada = "";

    $existe = "false";
    $letrasDigitadas = "";
    $sublinhados = [];

    $jogadores = array_keys($placar);
    $totalJodagores = count($jogadores);
    $vezJogador = 0;

        do{
            // Array é transformado em palavra para realizar processamento
            foreach (str_split($palavraSortida) as $key => $letra){

                // Verifica se a posição não existe
                if (!isset($sublinhados[$key]))
                    $sublinhados[$key] = "_";

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

            // Verifica existência da letra e se já foi usada
            if (!$existe && !str_contains($letrasDigitadas, $letraDigitada)){
                $letrasDigitadas .= "$letraDigitada, ";
                $placar[$jogadores[$vezJogador]]["vidas"]--;
                $placar[$jogadores[$vezJogador]]["pontos"]--;

                echo "\n Letra inválida, -1 vida \n {$jogadores[$vezJogador]} possui {$placar[$jogadores[$vezJogador]]["vidas"]} vidas restantes!\n";       
            }

            $tentativas = ($totalJodagores === 2) 
            ? array_sum(array_column($placar, "vidas"))
            : $placar[$jogadores[$vezJogador]]["vidas"];


            if ($palavraImplode == $palavraSortida || $tentativas === 0){
                echo ($totalJodagores > 1) 
                ? resultadoPlacar2($placar, $jogadores) 
                : resultadoPlacar1($placar[$jogadores[$vezJogador]]["vidas"]);
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

// Retorna os dados do arquivo csv

function extrairDados(){
    $dadosExtraidos = [];

    // Verifica se o arquivo existe
    if(($handle = fopen("Lib/data.csv", "r"))){

        // Seleciona e pula a primeria linha (caeçalho)
        $cabecalho = fgetcsv($handle, 0, ";");

        // Executa enquanto existir palavras no arquivo
        while (($fields =  fgetcsv($handle, 0, ";"))) {

        // extrai os dados com chave e valores
        $dadosExtraidos[] = array_combine($cabecalho, $fields); 
        }

        fclose($handle);      
    } else {
         die("O diretório não existe!");
    }

    return $dadosExtraidos;
}

// Filtra apenas a categoria selecionada

function filtrarCategoria(array $nArray, string $categoriaSelecionada){

    // Seleciona apenas a categoria selecionada 
    $arrayCategoria = array_filter($nArray, fn($cat) => $cat['categoria'] == strtolower($categoriaSelecionada));

    if(empty($arrayCategoria)){
        return false;
    } 
    
    return $arrayCategoria;
}

// Valida existência da categoria informada

function verificarCategoria(array $nArray, bool $retorno){
    menuCategorias($nArray);

    do{
        $categoria = strtolower(readline("Informe uma categoria: "));
        $resultado = filtrarCategoria($nArray, $categoria);
    }while (!$resultado);

    if ($retorno) return $resultado;

    return $categoria;
}

//Exibe o menu e retorna a categoria já validada

function menuCategorias(array $nArray){

    //Seleciona apenas os valores de categoria 
    $arrayCategorias = array_unique(array_column($nArray, 'categoria'));
    $i = 0;

    echo "\n\t|-------------------------------------------|\n";

    foreach ($arrayCategorias as $categoria){
        echo "\t|         \t $i - $categoria \t            |\n";
        $i++;
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

function selecionarPalavra(array $nArray){
    $categoria = verificarCategoria($nArray, false);

    $palavra = strtolower(readline("Informa a palavra que deseja adicionar: "));

    return [
        'id' => uniqid(),
        'categoria' => $categoria,
        'palavra' => $palavra
    ];
}


// Adiciona uma palavra nova a sua devida categoria

function adicionarPalavra(array $nArray){

    if(($handle = fopen("Lib/data.csv", "a"))){

        fputcsv($handle, $nArray, ";");

        fclose($handle);
    }
}

// Adicionar jogadores ao jogo

function resultadoPlacar2(array $placar, array $jogador){
    [$jogador1, $jogador2] = $jogador;

    $pontos1 = $placar[$jogador1]["pontos"];
    $pontos2 = $placar[$jogador2]["pontos"];

    if ($pontos1 > $pontos2) return "O(A) $jogador1 ganhou o jogo, com $pontos1 pontos! \n";

    if ($pontos2 > $pontos1) return "O(A) $jogador2 ganhou o jogo, com $pontos2 pontos! \n";

    return "O jogo empatou \n";
}

function resultadoPlacar1(int $vidas){
    if ($vidas > 0) return "\nVocê ganhou o jogo!\n";

    return "\nVocê perdeu o jogo!\n";
}

// Retorna cadastro de jogadores

function cadastrarJogadores(){
    echo "1 - 1 Jogador \n2 - 2 Jogadores\n";

    if ((readline("Com quantos jogadores deseja jogar?: ")) === "1"){
        return [readline("Informe seu nome: ") => [
                "pontos" => 0,
                "vidas" => 6
                ],
            ];
    }

    return [
               readline("Informe o nome do jogador 1: ") => [
                "pontos" => 0,
                "vidas" => 3
               ],
               readline("Informe o nome do jogador 2: ") => [
                "pontos" => 0,
                "vidas" => 3
               ]
            ];
}

function limpar(){
    return "\033[2J\033[;H";
}
