<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Classe responsável por gerenciar o cliente
 * @author Guilherme Correia
 */
#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente implements \JsonSerializable
{
    /**
     * atributos de cliente
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $nomeCliente;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $tipoCliente;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $emailCliente;

    #[ORM\Column(type: 'integer', length: 14, nullable: true)]
    public ?int $celularCliente;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $cpf_cnpj;

    /**
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */

    public function getNomeCliente(): ?string
    {
        return $this->nomeCliente;
    }

    public function setNomeCliente(string $nomeCliente): void
    {
        $this->nomeCliente = $nomeCliente;
    }

    /**
     * @return string|null
     */

    public function getTipoCliente(): ?string
    {
        return $this->tipoCliente;
    }



    public function setTipoCliente(string $tipoCliente): void
    {
        $this->tipoCliente = $tipoCliente;
    }

    /**
     * @return string|null
     */

    public function getEmailCliente(): ?string
    {
        return $this->emailCliente;
    }

    public function setEmailCliente(string $emailCliente): void
    {
        $this->emailCliente = $emailCliente;
    }

    /**
     * @return int|null
     */
    public function getCelularCliente(): ?int
    {
        return $this->celularCliente;
    }


    public function setCelularCliente(int $celularCliente): void
    {
        $this->celularCliente = $celularCliente;
    }

    /**
     * @return string|null
     */

    public function getCpfCnpj(): ?string
    {
        return $this->cpf_cnpj;
    }


    public function setCpfCnpj(string $cpf_cnpj): void
    {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    #[ArrayShape(["Id" => "int", "nomeCliente" => "string", "tipoCliente" => "string", "emailCliente" => "string", "celularCliente" => "int", "cpf_cnpj" => "string"])]
    public function jsonSerialize(): array
    {
        return [
            "Id" => $this->getId(),
            "nomeCliente" => $this->getNomeCliente(),
            "tipoCliente" => $this->getTipoCliente(),
            "emailCliente" => $this->getEmailCliente(),
            "celularCliente" => $this->getCelularCliente(),
            "cpf_cnpj" => $this->getCpfCnpj()
        ];
    }
}