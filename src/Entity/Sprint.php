<?php

namespace App\Entity;

use App\Repository\SprintRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Internal\TentativeType;

#[ORM\Entity(repositoryClass: SprintRepository::class)]
/**
 * Classe responsável por gerenciar a tabela sprint
 * @author Guilherme Correia
 */
class Sprint implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    public ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $situacao = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $descricao = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $versao = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $duracao = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $dataIni = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $dataFim = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(?string $situacao): self
    {
        $this->situacao = $situacao;

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

    public function getVersao(): ?string
    {
        return $this->versao;
    }

    public function setVersao(?string $versao): self
    {
        $this->versao = $versao;

        return $this;
    }

    public function getDuracao(): ?string
    {
        return $this->duracao;
    }

    public function setDuracao(?string $duracao): self
    {
        $this->duracao = $duracao;

        return $this;
    }

    public function getDataIni(): ?\DateTimeInterface
    {
        return $this->dataIni;
    }

    public function setDataIni(?\DateTimeInterface $dataIni): self
    {
        $this->dataIni = $dataIni;

        return $this;
    }

    public function getDataFim(): ?\DateTimeInterface
    {
        return $this->dataFim;
    }

    public function setDataFim(?\DateTimeInterface $dataFim): self
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    #[ArrayShape(["Id" => "int|null", "situacao" => "null|string", "descricao" => "null|string", "versao" => "null|string", "duracao" => "null|string", "dataIni" => "\DateTimeInterface|null", "dataFim" => "\DateTimeInterface|null"])]
    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "situacao" => $this->getSituacao(),
            "descricao" => $this->getDescricao(),
            "versao" => $this->getVersao(),
            "duracao" => $this->getDuracao(),
            "dataIni" => $this->getDataIni(),
            "dataFim" => $this->getDataFim()
        ];
    }
}
