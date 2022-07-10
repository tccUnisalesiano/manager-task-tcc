<?php

namespace App\Helper;

use App\Entity\Cliente;

class ClienteFactory
{
    public function criarCliente(string $json): Cliente
    {
        $dados = json_decode($json);

        @$cliente = new Cliente();
        @$cliente->nomeCliente = $dados->nomeCliente;
        @$cliente->tipoCliente = $dados->tipoCliente;
        @$cliente->emailCliente = $dados->emailCliente;
        @$cliente->celularCliente = $dados->celularCliente;
        @$cliente->cpf_cnpj = $dados->cpf_cnpj;

        return $cliente;
    }
}