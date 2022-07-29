<?php

namespace App\Entity;

use App\Repository\ValorfuncionarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Internal\TentativeType;

/**
 * Classe responsável por gerenciar os métodos de Valor do Funcionario
 * @author Guilherme Correia
 */
#[ORM\Entity(repositoryClass: ValorfuncionarioRepository::class)]
class Valorfuncionario implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    public ?int $id = null;

    #[ORM\ManyToOne]
    public ?Funcionario $idFuncionario = null;

    #[ORM\Column(nullable: true)]
    public ?float $valorHora = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $dataIni = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $dataFim = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFuncionario(): ?Funcionario
    {
        return $this->idFuncionario;
    }

    public function setIdFuncionario(?Funcionario $idFuncionario): self
    {
        $this->idFuncionario = $idFuncionario;

        return $this;
    }

    public function getValorHora(): ?float
    {
        return $this->valorHora;
    }

    public function setValorHora(?float $valorHora): self
    {
        $this->valorHora = $valorHora;

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

    #[ArrayShape(["Id" => "int|null", "idFuncionario" => "\App\Entity\Funcionario|null", "valorHora" => "float|null", "dataIni" => "\DateTimeInterface|null", "dataFim" => "\DateTimeInterface|null"])]
    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "idFuncionario" => $this->getIdFuncionario(),
            "valorHora" => $this->getValorHora(),
            "dataIni" => $this->getDataIni(),
            "dataFim" => $this->getDataFim()
        ];
    }
}
