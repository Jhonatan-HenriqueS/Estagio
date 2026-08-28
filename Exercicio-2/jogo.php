<?php

$forca = ["casa", "carro", "livro", "computador", "guarda-chuva", "pe-de-muleque"];

do{
    echo("
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo        |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
    \n");

    $escolha = readline("Informe a opção desejada: ");
    echo "\033[2J\033[;H";


    switch($escolha){
        case 1:
            echo "
                |-------------------------------------------|
                |        Opção 1 - Objetos                  |
                |        Opção 2 - animais                  |
                |        Opção 3 - personagens              |
                |        Opção 4 - verbos                   |
                |        Opção 5 - filmes                   |
                |        Opção 6 - profissoes               |
                |        Opção 7 - lugares                  |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
            ";

       $dadosCSV = extrairDados();
       $categoria = readline("Informe uma categoria: ");       
       $resultadoFinal = exibirVidas(exibirCsv($dadosCSV, $categoria));
       echo $resultadoFinal;
            break;
        case 0:
            echo "\n Finalizado! \n"; 
            break;
        default:
            echo "\n Opção inválida, tente novamente. \n";
            break;
    }
}while($escolha != 0);

//Atividade C: Criar uma função que existe apenas 6 vidas, ou seja, se errar 6 vezes o jogador perde

function exibirVidas(array $nArray){

    $palavraSortida = $nArray[array_rand($nArray)];
    $letraDigitada = "";

    $existe = "false";
    $vidasRestantes = 6;
    $letrasDigitadas = "";
    $sublinhados = [];

        do{

            // Array é transformado em palavra para realizar processamento
            foreach (str_split($palavraSortida['palavra']) as $key => $letra){

                // Verifica se a posição não existe
                if (!isset($sublinhados[$key]))
                    $sublinhados[$key] = " _ ";

                // Verifica se há hifen
                if ($letra === "-"){
                    $sublinhados[$key] = " - ";
                    continue;
                }   

                // Verifica se a letra existe e exibe
                if ($letraDigitada == $letra){
                    $sublinhados[$key] = " $letra ";
                    $existe = true;
                }
                         
            }

            // Transforma o Array em uma palavra
            $palavraImplode = implode('', $sublinhados);

            if (!$existe){
                
                // Verifica se é uma letra 
                if (ctype_lower($letraDigitada) && !str_contains($letrasDigitadas, $letraDigitada)){ 
                    $vidasRestantes--;
                    $letrasDigitadas .= "$letraDigitada, ";
                    echo "\n Letra inválida, -1 vida \n Você possui $vidasRestantes vidas restantes!\n";
                }

            }

            // Encerra o código caso a palavra foi encontrada ou as vidas acabaram
            if (str_replace(' ', '', $palavraImplode) == $palavraSortida['palavra'] || $vidasRestantes == 0) break;

            echo $palavraImplode;  
            echo ($letrasDigitadas == "") ? "\nNenhum erro até o momento\n" : "\nLetras já usadas: $letrasDigitadas \n";

           do{
             $letraDigitada = readline("Informe uma letra ou 0 para encerrar: ");
           } while(strlen($letraDigitada) != 1 && $letraDigitada != "0");
           
            $existe = false;

            echo "\033[2J\033[;H";

        } while ($letraDigitada != "0");

    return $palavraSortida['palavra'];
}

//Atividade D: As palvras do jogo devem ser de outro arquivo em .csv, o usuário deve escolher a categoria e pode adicionar uma nova palavra

// Retorna os dados do arquivo csv

function extrairDados(){
    $dadosExtraidos = [];

    // Abre o arquivo
    if(($handle = fopen("Lib/data.csv", "r"))){

        // Seleciona e pula a primeria linha (caeçalho)
        $cabecalho = fgetcsv($handle, 0, ";");

        // Executa enquanto existir palavras no arquivo
        while (($fields =  fgetcsv($handle, 0, ";"))) {

        // extrai os dados com chave e valores
        $dadosExtraidos[] = array_combine($cabecalho, $fields); 
        }

        // Encerra a leitura 
        fclose($handle);      
    } else {
        return "O diretório não existe!";
    }

    return $dadosExtraidos;
}

function exibirCsv(array $nArray, $categoriaSelecionada){

    // Seleciona apenas a categoria selecionada 
    $arrayCategoria = array_filter($nArray, fn($cat) => $cat['categoria'] == $categoriaSelecionada);

    if(empty($arrayCategoria)){
        return "A categoria selecionada não foi encontrada!";
    } 
    
    return $arrayCategoria;
}

