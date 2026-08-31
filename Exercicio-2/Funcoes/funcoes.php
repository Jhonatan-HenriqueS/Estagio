<?php

//Lógica do jogo da forca

function exibirVidas(array $nArray, array $placar){

    $palavraSortida = $nArray[array_rand($nArray)]['palavra'];
    $letraDigitada = "";

    $existe = "false";
    $tentativas = 6;
    $letrasDigitadas = "";
    $sublinhados = [];

    $jogadores = array_keys($placar);
    $vezJogador = 0;

        do{
            $vezJogador = !$vezJogador;
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
                $tentativas--;
                $letrasDigitadas .= "$letraDigitada, ";
                $placar[$jogadores[$vezJogador]]["vidas"]--;

                echo "\n Letra inválida, -1 vida \n Você possui $tentativas tentativas restantes!\n";
            }

            if ($palavraImplode == $palavraSortida || $tentativas == 0){
                echo resultadoPlacar($placar($jogadores));
                break;
            }

            echo $palavraImplode;

            foreach ($placar as $jogador => $placarJogador) {
                echo "\nO Jogador $jogador está com: {$placarJogador["pontos"]} pontos";
            }  

            echo ($letrasDigitadas == "") ? "\nNenhum erro até o momento\n" : "\nLetras já usadas: $letrasDigitadas \n";

            $letraDigitada = verificarLetra($letraDigitada, $jogadores[$vezJogador]);
            $existe = false;

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

function verificarLetra(string $letra, string $jogador){
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

function resultadoPlacar($placar){
    if ($placar[0] > $placar[1]) return "O(A) {$placar[0]} ganhou o jogo \n";

    if ($placar[0] == $placar[1]) return "O jogo empatou \n";
        
    return "O(A) {$placar[1]} ganhou o jogo\n";
}

// Retorna cadastro de jogadores

function cadastrarJogadores(){
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
