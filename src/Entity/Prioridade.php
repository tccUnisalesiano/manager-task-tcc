<?php

namespace App\Entity;

use App\Repository\PrioridadeRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Classe responsável por gerenciar prioridade
 * @author Guilherme Correia
 */
#[ORM\Entity(repositoryClass: PrioridadeRepository::class)]
class Prioridade implements \JsonSerializable
{
    /**
     * Atributos de prioridade
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public string $nomePrioridade;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public string $cor;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomePrioridade(): string
    {
        return $this->nomePrioridade;
    }

    /**
     * @param string $nomePrioridade
     */
    public function setNomePrioridade(string $nomePrioridade): void
    {
        $this->nomePrioridade = $nomePrioridade;
    }

    /**
     * @return int
     */
    public function getCor(): int
    {
        return $this->cor;
    }

    /**
     * @param int $cor
     */
    public function setCor(int $cor): void
    {
        $this->cor = $cor;
    }


    #[ArrayShape(["Id" => "int", "nomePrioridade" => "string", "cor" => "int"])]
    public function jsonSerialize(): array
    {
        return[
          "Id" => $this->getId(),
          "nomePrioridade" => $this->getNomePrioridade(),
          "cor" => $this->getCor()
        ];
    }
}