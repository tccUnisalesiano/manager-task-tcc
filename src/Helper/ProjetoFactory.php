<?php

namespace App\Helper;

use App\Entity\Projeto;

class ProjetoFactory
{
    public function criarProjeto(string $json): Projeto
    {
        $dados = json_decode($json);

        @$projeto = new Projeto();
        @$projeto->nomeProjeto = $dados->nomeProjeto;
        @$projeto->descricao = $dados->descricao;

        return $projeto;
    }
}