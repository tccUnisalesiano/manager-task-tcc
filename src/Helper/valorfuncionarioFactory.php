<?php

namespace App\Helper;

use App\Entity\Valorfuncionario;

class valorfuncionarioFactory
{
    public function criarVfuncionario(string $json): Valorfuncionario
    {
        $dados = json_decode($json);

        @$vFuncionario = new Valorfuncionario();
        @$vFuncionario->idUser = $dados->idUser;
        @$vFuncionario->valorHora = $dados->valorHora;
        @$vFuncionario->dataIni = $dados->dataIni;
        @$vFuncionario->dataFim = $dados->dataFim;

        return $vFuncionario;
    }
}