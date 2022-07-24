<?php

namespace App\Entity;

use App\Repository\ProjetoRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

#[ORM\Entity(repositoryClass: ProjetoRepository::class)]
/**
 * Classe responsável por gerenciar a tabela projeto
 * @author Guilherme Correia
 */
class Projeto implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    public ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $nomeProjeto = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $descricao = null;

//    #[ORM\ManyToOne(inversedBy: 'idProjeto')]
//    private ?Cliente $idCliente = null;
//
//    #[ORM\ManyToOne(inversedBy: 'idProjeto')]
//    private ?Situacao $idSituacao = null;

    /**
     * @param int|null $id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param string|null $nome
     * @return $this
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param string|null $descricao
     * @return $this
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    #[ArrayShape(["Id" => "int|null", "nome" => "null|string", "descricao" => "null|string"])]
    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "nome" => $this->getNome(),
            "descricao" => $this->getDescricao()
        ];
    }
}
