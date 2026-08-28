<?php

$forca = ["casa", "carro", "livro", "computador", "guarda-chuva", "pe-de-muleque"];

do{
    echo("
                |-------------------------------------------|
                |        Opção 1 - Iniciar novo jogo (A)    |
                |        Opção 2 - Iniciar novo jogo (B)    |
                |        Opção 3 - Iniciar novo jogo (C)    |
                |        Opção 4 - Iniciar novo jogo (D)    |
                |        Opção 0 - Sair                     |
                |-------------------------------------------| 
\n");

$escolha = readline("Informe a opção desejada: ");
echo "\033[2J\033[;H";


    switch($escolha){
        
        case 1:    
            $sublinhado = exibirSublinhado($forca);
            echo "Adivinhe a palavra \n $sublinhado";           
            break;
        case 2:
            $resultadoFinal = exibirAcertos($forca);
            echo "\n Finalizado! \nA palavra era: $resultadoFinal";
            break;
        case 3:
            $resultadoFinal = exibirVidas($forca);
            echo "\n Finalizado! \nA palavra era: $resultadoFinal";
            break;
        case 4:
        //    do {
        //     echo "
        //         |-------------------------------------------|
        //         |        Opção 1 - Objetos                  |
        //         |        Opção 2 - animais                  |
        //         |        Opção 3 - personagens              |
        //         |        Opção 4 - verbos                   |
        //         |        Opção 5 - filmes                   |
        //         |        Opção 6 - profissoes               |
        //         |        Opção 7 - lugares                  |
        //         |        Opção 0 - Sair                     |
        //         |-------------------------------------------| 
        //     ";
        //     $categoriaInformada = readline("Seleciona a categoria que deseja jogar: ");

        //    } while(ctype_lower($categoriaInformada) !== true && $categoriaInformada != 0);

       $dadosCSV = extrairDados();

       print_r($dadosCSV);

            
            break;
        case 0:
            echo "\n Finalizado! \n";
            break;
        default:
            echo "\n Opção inválida, tente novamente. \n";
            break;
    }
}while($escolha != 0);

//Atividade A: Criar uma função que cria campos para as letras do jogo da forca.

function exibirSublinhado(array $nArray){

    $chave = array_rand($nArray);
    
    $sublinhados = "";
    foreach (str_split($nArray[$chave]) as $letra){
        if ($letra === "-"){
            $sublinhados .= " - ";
            continue;
        }

        $sublinhados .= " _ ";

    }

    return $sublinhados;
}

//Atividade B: Criar uma função que agora verifica se as letras digitadas pelo o usuário possuem nos campos, se sim, deve mostra-las. 

function exibirAcertos(array $nArray){

    $chave = array_rand($nArray);
    $palavraSortida = $nArray[$chave];
    $letraDigitada = "";
    $sublinhados = [];

        do{
            
            foreach (str_split($palavraSortida) as $key => $letra){
                if (!isset($sublinhados[$key]))
                    $sublinhados[$key] = " _ ";

                if ($letra === "-"){
                    $sublinhados[$key] = " - ";
                    continue;
                }   

                if ($letraDigitada == $letra){
                    $sublinhados[$key] = " $letra ";
                }
            }

            $palavraImplode = implode('', $sublinhados);

            if (str_replace(' ', '', $palavraImplode) == $palavraSortida)
                break;

            echo $palavraImplode;
            echo "\n\nAdivinhe a palavra \n";
            $letraDigitada = readline("Informe uma letra ou 0 para encerrar: ");

        } while ($letraDigitada != "0");

    return $palavraSortida;
}

//Atividade C: Criar uma função que existe apenas 6 vidas, ou seja, se errar 6 vezes o jogador perde

function exibirVidas(array $nArray){

    $chave = array_rand($nArray);
    $palavraSortida = $nArray[$chave];
    $letraDigitada = "";

    $existe = "false";
    $vidasRestantes = 6;
    $letrasDigitadas = "";
    $sublinhados = [];

        do{
            //Trasnforma a palavra em um array
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

            //Verifica se a palavra foi encontrada
            if (!$existe){
                //Verifica se é letra e se ela é minuscula; e verifica se a palavra não foi digitada
                if (ctype_lower($letraDigitada) && !str_contains($letrasDigitadas, $letraDigitada)){ //C_W Verifica se é letra e se é minúscula e str_C verifica a palvra dentro das palvras digitadas
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

            //Enquanto o usuário não digitar apenas um caractere ou 0, o código pergunta a letra
            do{
                $letraDigitada = readline("Informe uma letra ou 0 para encerrar: ");
            }while (strlen(trim($letraDigitada)) != 1 && $letraDigitada != "0");

            //Esse false permite que o foreach não verifique o false de primeira, p não ter erros
            $existe = false;

            //Limpa o terminal
            echo "\033[2J\033[;H";

        } while ($letraDigitada != "0");

    return $palavraSortida;
}

//Atividade D: As palvras do jogo devem ser de outro arquivo em .csv, o usuário deve escolher a categoria e pode adicionar uma nova palavra

// function exibirScv(array $nArray, $categoriaSelecionada){

//         //preocura categoria dentro de cabeçalho e retorna a chave

//         if ($chaveCategoria !== false && $chavePalavra !== false){

//         } else {
//             return "Coluna ou palavra não econtrada!";
//         }

    
//     return $categoriaArray;
// }

//Abrir arquivo .CSV e retorna o array de todos os valores

function extrairDados(){
    $dadosExtraidos = [];
    //Seleciona o arquivo desejado e "r" é para abrir como leitura e passa para a váriavel; Se o arquivo selecionado existe (true), execute
    if(($handle = fopen("Lib/data.csv", "r"))){

        //Pula a primeira linha (cabeçalho)
        $cabecalho = fgetcsv($handle, 0, ";");

        //Seleciona cada coluna e seus devidos valores dentro do csv e passa para a váriavel; Enquanto exisitir palavra, execute
        while (($fields =  fgetcsv($handle, 0, ";"))) {
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

