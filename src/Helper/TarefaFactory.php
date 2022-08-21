<?php

namespace App\Helper;

use App\Entity\Tarefa;

/**
 * Classe responsável por gerenciar um novo objeto Tarefa
 * @author Guilherme Correia
 */
class TarefaFactory
{
    public function criarTarefa(string $json): Tarefa
    {
        $dados = json_decode($json);

        @$tarefa = new Tarefa();
        @$tarefa->idProjeto = $dados->idProjeto;
        @$tarefa->prioridade = $dados->prioridade;
        @$tarefa->situacao = $dados->situacao;
        @$tarefa->status = $dados->status;
        @$tarefa->nome = $dados->nome;
        @$tarefa->descricao = $dados->descricao;
        @$tarefa->tempoEstimado = $dados->tempoEstimado;
        @$tarefa->dataIni = $dados->dataIni;
        @$tarefa->dataFim = $dados->dataFim;
//        @$tarefa->documentacao = $dados->documentacao;
        @$tarefa->tipoTarefa = $dados->tipoTarefa;
        @$tarefa->idFuncionario = $dados->idFuncionario;

        return $tarefa;
    }
}