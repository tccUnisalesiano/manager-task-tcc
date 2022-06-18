<?php

namespace App\Helper;

use App\Entity\Funcionario;

class FuncionariosFactory
{
    public function criarFuncionario(string $json): Funcionario
    {
        $dadoEmJson = json_decode($json);

        @$funcionario = new Funcionario();
        @$funcionario->nomeFuncionario = $dadoEmJson->nomeFuncionario;
        @$funcionario->senha = $dadoEmJson->senha;
        @$funcionario->emailFuncionario = $dadoEmJson->emailFuncionario;
        @$funcionario->cargaHorariaSemanal = $dadoEmJson->cargaHorariaSemanal;
       // $funcionario->imagemPerfil = $dadoEmJson->imagemPerfil;

        return $funcionario;
    }
}