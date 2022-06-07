<?php

namespace App\Helper;

use App\Entity\Funcionario;

class FuncionariosFactory
{
    public function criarFuncionario(string $json): Funcionario
    {
        $dadoEmJson = json_decode($json);

        $funcionario = new Funcionario();
        $funcionario->nomeFuncionario = $dadoEmJson->nomeFuncionario;
        $funcionario->emailFuncionario = $dadoEmJson->emailFuncionario;
        $funcionario->senha = $dadoEmJson->senha;
        $funcionario->cargaHorariaSemanal = $dadoEmJson->cargaHorariaSemanal;
       // $funcionario->imagemPerfil = $dadoEmJson->imagemPerfil;

        return $funcionario;
    }
}