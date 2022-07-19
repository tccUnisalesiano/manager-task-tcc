<?php

namespace App\Helper;

use App\Entity\Situacao;

/**
 * Classe responsável pro gerenciar um novo objeto de situacao
 * @author Guilherme Correia
 */
class SituacaoFactory
{
    public function criarSituacao(string $json): Situacao
    {
        $dados = json_decode($json);

        @$situacao = new Situacao();

        @$situacao->descricao = $dados->descricao;

        return $situacao;
    }
}