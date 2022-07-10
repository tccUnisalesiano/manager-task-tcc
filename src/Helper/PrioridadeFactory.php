<?php

namespace App\Helper;

use App\Entity\Prioridade;

/**
 * Classe responsável por gerenciar um novo objeto prioridade
 * @author Guilherme Correia
 */
class PrioridadeFactory
{
    public function criarPrioridade(string $json): Prioridade
    {
        $dados = json_decode($json);

        @$prioridade = new Prioridade();
        @$prioridade->nomePrioridade = $dados->nomePrioridade;
        @$prioridade->cor = $dados->cor;

        return $prioridade;
    }
}