<?php

namespace App\Entity;

use App\Repository\TempogastoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Classe responsável por gerenciar os métodos de Tempo Gasto
 * @author Guilherme Correia
 */
#[ORM\Entity(repositoryClass: TempogastoRepository::class)]
class Tempogasto implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    public ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $atividade = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $data = null;

    #[ORM\Column(nullable: true)]
    public ?float $tempo = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $descricao = null;

    #[ORM\ManyToOne]
    public ?Tarefa $idTarefa = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    public ?User $idUser;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAtividade(): ?string
    {
        return $this->atividade;
    }

    public function setAtividade(?string $atividade): self
    {
        $this->atividade = $atividade;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getTempo(): ?float
    {
        return $this->tempo;
    }

    public function setTempo(?float $tempo): self
    {
        $this->tempo = $tempo;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getIdTarefa(): ?Tarefa
    {
        return $this->idTarefa;
    }

    public function setIdTarefa(?Tarefa $idTarefa): self
    {
        $this->idTarefa = $idTarefa;

        return $this;
    }


    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    #[ArrayShape(["Id" => "int|null", "atividade" => "null|string", "data" => "\DateTimeInterface|null", "tempo" => "float|null", "descricao" => "null|string", "idTarefa" => "\App\Entity\Tarefa|null", "idUser" => "\App\Entity\User|null"])]
    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "atividade" => $this->getAtividade(),
            "data" => $this->getData(),
            "tempo" => $this->getTempo(),
            "descricao" => $this->getDescricao(),
            "idTarefa" => $this->getIdTarefa(),
            "idUser" => $this->getIdUser(),
        ];
    }


}
