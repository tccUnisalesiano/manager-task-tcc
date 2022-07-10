<?php

namespace App\Entity;

use App\Repository\SituacaoRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Classe responsável por gerenciar a situaçao da tarefa
 * @author  Guilherme Correia
 */
#[ORM\Entity(repositoryClass: SituacaoRepository::class)]
class Situacao implements \JsonSerializable
{

    /**
     * Atributos da table situacao
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    public string $descricao;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    #[ArrayShape(["Id" => "int", "descricao" => "string"])]
    public function jsonSerialize(): array
    {
        return [
            "Id" => $this->getId(),
            "descricao" => $this->getDescricao()
        ];
    }
}