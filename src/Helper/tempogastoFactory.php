<?php

namespace App\Helper;

use App\Entity\Tempogasto;

/**
 * Classe responsável por gerenciar um novo objeto Tempo Gasto
 * @author Guilherme Correia
 */
class tempogastoFactory
{
    public function criarTempogasto(string $json): Tempogasto
    {
        $dados = json_decode($json);

        @$tempogasto = new Tempogasto();
        @$tempogasto->atividade = $dados->atividade;
        @$tempogasto->data = $dados->data;
        @$tempogasto->tempo = $dados->tempo;
        @$tempogasto->descricao = $dados->descricao;
        @$tempogasto->idTarefa = $dados->idTarefa;
        @$tempogasto->idValorFuncionario = $dados->idValorFuncionario;

        return $tempogasto;
    }
}