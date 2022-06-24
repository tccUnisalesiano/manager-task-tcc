<?php

namespace App\Helper;

use App\Entity\Funcionario;

class FuncionariosFactory
{
    public function criarFuncionario(string $json): Funcionario
    {
        $dadoEmJson = json_decode($json);

<<<<<<< HEAD
        $funcionario = new Funcionario();
        $funcionario->nomeFuncionario = $dadoEmJson->nomeFuncionario;
        $funcionario->emailFuncionario = $dadoEmJson->emailFuncionario;
        $funcionario->senha = $dadoEmJson->senha;
        $funcionario->cargaHorariaSemanal = $dadoEmJson->cargaHorariaSemanal;
=======
        @$funcionario = new Funcionario();
        @$funcionario->nomeFuncionario = $dadoEmJson->nomeFuncionario;
        @$funcionario->senha = $dadoEmJson->senha;
        @$funcionario->emailFuncionario = $dadoEmJson->emailFuncionario;
        @$funcionario->cargaHorariaSemanal = $dadoEmJson->cargaHorariaSemanal;
>>>>>>> a5999729b4306280b15b3321ec878988fd0a2577
       // $funcionario->imagemPerfil = $dadoEmJson->imagemPerfil;

        return $funcionario;
    }
}