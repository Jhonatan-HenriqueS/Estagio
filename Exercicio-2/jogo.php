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
        //     $categoriaInformada = readline("Seleciona a categoria que deseja jogar: ");

        //    } while(ctype_lower($categoriaInformada) !== true && $categoriaInformada != 0);

       $dadosCSV = extrairDados();

       $categoria = readline("Informe uma categoria: ");
       exibirCsv($dadosCSV, $categoria);
            
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

function sortearPalavra ($array) {
    return $array[array_rand($array)];
}

function exibirVidas(array $nArray){

    $palavraSortida = sortearPalavra($nArray);
    $letraDigitada = "";

    $existe = "false";
    $vidasRestantes = 6;
    $letrasDigitadas = "";
    $sublinhados = [];

        do{
            // Array é transformado em palavra para realizar processamento
            foreach (str_split($palavraSortida) as $key => $letra){
                //Se na chave encontrada não possuir nenhum valor, adiciona _
                if (!isset($sublinhados[$key]))
                    $sublinhados[$key] = " _ ";

                //Se a letra for -, adiciona no array e pula o restante do código
                if ($letra === "-"){
                    $sublinhados[$key] = " - ";
                    continue;
                }   

                //Se a letra for igual a letra na posição do array, o array na posição key recebe a letra 
                if ($letraDigitada == $letra){
                    $sublinhados[$key] = " $letra ";
                    $existe = true;
                }
                         
            }

            //Transforma o array em letras
            $palavraImplode = implode('', $sublinhados);

            if (!$existe){
                
                //Faço a verificação da letra digitada para descontar a vida. Verifico se é letra minúscula e se ela já existe
                if (ctype_lower($letraDigitada) && !str_contains($letrasDigitadas, $letraDigitada)){ 
                    $vidasRestantes--;
                    echo "\n Letra inválida, -1 vida \n Você possui $vidasRestantes vidas restantes!\n";
                    $letrasDigitadas .= "$letraDigitada, ";
                }
            }
            

            //Troca os espaços da palavra por nenhum
            if (str_replace(' ', '', $palavraImplode) == $palavraSortida || $vidasRestantes == 0)
                break;

            echo $palavraImplode;  
            echo ($letrasDigitadas == "") ? "\nNenhum erro até o momento\n" : "\nLetras já usadas: $letrasDigitadas \n";

            do{
                $letraDigitada = ctype_lower(readline("Informe uma letra ou 0 para encerrar: "));
            }while (strlen(trim($letraDigitada)) != 1 && $letraDigitada != "0");

            $existe = false;

            echo "\033[2J\033[;H";

        } while ($letraDigitada != "0");

    return $palavraSortida;
}

//Atividade D: As palvras do jogo devem ser de outro arquivo em .csv, o usuário deve escolher a categoria e pode adicionar uma nova palavra

function exibirCsv(array $nArray, $categoriaSelecionada){

    $arrayCategoria = array_filter($nArray, function ($cat) {

    });

    if(!$arrayCategoria){
        return "A categoria selecionada não foi encontrada!";
    } else {
        return $arrayCategoria;
    }
}

//Abrir arquivo .CSV e retorna o array de todos os valores

function extrairDados(){
    $dadosExtraidos = [];
    //Seleciona o arquivo desejado e "r" é para abrir como leitura e passa para a váriavel; Se o arquivo selecionado existe (true), execute
    if(($handle = fopen("Lib/data.csv", "r"))){

        //Pula a primeira linha (cabeçalho)
        $cabecalho = fgetcsv($handle, 0, ";");

        //Seleciona cada coluna e seus devidos valores dentro do csv e passa para a váriavel; Enquanto exisitir palavra, execute
        while (($fields =  fgetcsv($handle, 0, ";"))) {

            //A coluna vira chave daquele valor no meu array
            $dadosExtraidos[] = array_combine($cabecalho, $fields); 
        }

        //fecha o arquivo, já que ele foi aberto para leitura ou algo do tipo
        fclose($handle);      
    } else {
        return "O diretório não existe!";
    }

    return $dadosExtraidos;
}

//Função que repete ate o usuário digitar uma categoria válida

