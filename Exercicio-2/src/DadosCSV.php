<?php

namespace App;

class DadosCSV 
{
    private string $arquivo;

    public function __construct(string $arquivo)
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

    public function salvarCSV(array $nArray)
    {
        $handle = $this->abrirArquivo("a");

        fputcsv($handle, $nArray, ";");

        fclose($handle);
    }

    public function buscarPontos($jogador)
    {
        $dadosPlacar = $this->extrairDados();

        foreach ($dadosPlacar as $dados) {
            if ($dados['jogador'] === $jogador) {
                return $dados['pontos'];
            }
        }

        return 0;
    }

    public function atualizarPontos(string $jogador, int $pontosTotais)
    {
        $dadosPlacar = $this->extrairDados();

        foreach ($dadosPlacar as $chave => $dados) {
            if ($dados['jogador'] === $jogador) {
                $dadosPlacar[$chave]['pontos'] = $pontosTotais;
                break;
            }
        }

        $handle = $this->abrirArquivo("w");

        fputcsv($handle, ['jogador', 'pontos'], ';');

        foreach ($dadosPlacar as $dados) {
            fputcsv($handle, [
                $dados['jogador'],
                $dados['pontos']
            ], ';');
        }

        fclose($handle);
    }

}