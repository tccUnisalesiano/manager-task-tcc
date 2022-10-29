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
    public ?string $nome = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $descricao = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $situacao = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?\DateTimeInterface $dataIniPrevisto = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?\DateTimeInterface $dataFimPrevisto = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?\DateTimeInterface $dataEntregaFinal = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?\DateTimeInterface $dataInicial = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    public ?Cliente $cliente_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    public ?int $porcentagem = null;

    #[ORM\Column(type: 'float', nullable: true)]
    public ?float $tempoGastoTotal = null;

    /**
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */

    public function getNomeProjeto(): ?string
    {
        return $this->nome;
    }
    public function setNomeProjeto(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string|null
     */

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao = null): void
    {
        $this->descricao = $descricao;
    }


    /**
     * @return string|null
     */
    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(?string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }



    /**
     * @return \DateTimeInterface|null
     */

    public function getDataIniPrevisto(): ?\DateTimeInterface
    {
        return $this->dataIniPrevisto;
    }

    public function setDataIni(?\DateTimeInterface $dataIniPrevisto = null): self
    {
        $this->dataIniPrevisto = $dataIniPrevisto;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDataFimPrevisto(): ?\DateTimeInterface
    {
        return $this->dataFimPrevisto;
    }

    public function setDataFimPrevisto(?\DateTimeInterface $dataFimPrevisto = null): self
    {
        $this->dataFimPrevisto = $dataFimPrevisto;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDataEntregaFinal(): ?\DateTimeInterface
    {
        return $this->dataEntregaFinal;
    }

    public function setDataEntregaFinal(?\DateTimeInterface $dataEntregaFinal = null): self
    {
        $this->dataEntregaFinal = $dataEntregaFinal;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function setDataInicial(?\DateTimeInterface $dataInicial = null): self
    {
        $this->dataInicial = $dataInicial;

        return $this;
    }

    public function getDataInicial(): ?\DateTimeInterface
    {
        return $this->dataInicial;
    }

    public function getClienteId(): ?Cliente
    {
        return $this->cliente_id;
    }

    public function setClienteId(?Cliente $cliente_id): self
    {
        $this->cliente_id = $cliente_id;

        return $this;
    }


    public function getTempoGastoTotal(): ?float
    {
        return $this->tempoGastoTotal;
    }

    public function setTempoGastoTotal(?float $tempoGastoTotal = null): self
    {
        $this->tempoGastoTotal = $tempoGastoTotal;

        return $this;
    }

    #[ArrayShape(["Id" => "int", "nome" => "string", "descricao" => "string", "situacao" =>"string", "cliente_id" => "integer", "dataEntregaFinal" => "\DateTimeInterface","dataInicial" => "\DateTimeInterface","dataFimPrevisto" => "\DateTimeInterface", "dataIniPrevisto" => "\DateTimeInterface" ])]
    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "nome" => $this->getNomeProjeto(),
            "descricao" => $this->getDescricao(),
            "situacao" => $this->getSituacao(),
            "cliente_id"=>$this->getClienteId(),
            "dataEntregaFinal" => $this->getDataEntregaFinal(),
            "dataInicial" => $this->getDataInicial(),
            "dataFimPrevisto" => $this->getDataFimPrevisto(),
            "dataIniPrevisto" => $this->getDataIniPrevisto(),
            "tempoGastoTotal" => $this->getTempoGastoTotal(),
        ];
    }


}
