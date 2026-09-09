<?php

namespace App;

class DadosPalavras 
{
    private string $arquivo;

    public function __construct(string $arquivo = __DIR__ . '/../Lib/data.csv')
    {
        $this->arquivo = $arquivo;
    }

    private function abrirArquivo(string $modo)
    {
        $handle = fopen($this->arquivo, $modo);

        if (!$handle) {
            die("Não foi possível abrir o arquivo.");
        }

        return $handle;
    }

    public function extrairDados()
    {
        $dadosExtraidos = [];

        $handle = $this->abrirArquivo("r");

        $cabecalho = fgetcsv($handle, 0, ";");

        while (($fields = fgetcsv($handle, 0, ";")) ) {
            $dadosExtraidos[] = array_combine($cabecalho, $fields);
        }

        fclose($handle);

        return $dadosExtraidos;
    }

    public function salvarPalavraCSV(array $nArray)
    {
        $handle = $this->abrirArquivo("a");

        fputcsv($handle, $nArray, ";");

        fclose($handle);
    }
}