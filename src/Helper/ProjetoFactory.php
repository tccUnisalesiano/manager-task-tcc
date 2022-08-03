<?php

namespace App\Helper;

use App\Entity\Projeto;

class ProjetoFactory
{
    public function criarProjeto(string $json): Projeto
    {
        $dados = json_decode($json);

        @$projeto = new Projeto();
        @$projeto->nome = $dados->nome;
        @$projeto->descricao = $dados->descricao;
        @$projeto->situacao = $dados->situacao;
        @$projeto->cpf_cnpj = $dados->cpf_cnpj;
        @$projeto->dataEntregaFinal = $dados->dataEntregaFinal;
        @$projeto->dataFimPrevisto = $dados->dataFimPrevisto;
        @$projeto->dataIniPrevisto = $dados->dataIniPrevisto;
        @$projeto->dataInicial = $dados->dataInicial;

        return $projeto;
    }
}