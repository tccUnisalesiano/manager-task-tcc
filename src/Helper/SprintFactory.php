<?php

namespace App\Helper;

use App\Entity\Sprint;

/**
 * Classe responsável por gerenciar um novo objeto Sprint
 * @author Guilherme Correia
 */
class SprintFactory
{
    public function criarSprint(string $json): Sprint
    {
        $dados = json_decode($json);

        @$sprint = new Sprint();
        @$sprint->situacao = $dados->situacao;
        @$sprint->descricao = $dados->descricao;
        @$sprint->versao = $dados->versao;
        @$sprint->duracao = $dados->duracao;
        @$sprint->dataIni = $dados->dataIni;
        @$sprint->dataFim = $dados->dataFim;

        return $sprint;
    }
}