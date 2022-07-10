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

        @$Situacao = new Situacao();

        @$Situacao->descricao = $dados->descricao;

        return $Situacao;
    }
}