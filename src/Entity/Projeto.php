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

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $cpf_cnpj;


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
        return $this->nomeProjeto;
    }

    public function setNomeProjeto(string $nomeProjeto): void
    {
        $this->nomeProjeto = $nomeProjeto;
    }

    /**
     * @return string|null
     */

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
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

    /**
     * @return \DateTimeInterface|null
     */

    public function getDataIniPrevisto(): ?\DateTimeInterface
    {
        return $this->dataIniPrevisto;
    }

    public function setDataIni(?\DateTimeInterface $dataIniPrevisto): self
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

    public function setDataFimPrevisto(?\DateTimeInterface $dataFimPrevisto): self
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

    public function setDataEntregaFinal(?\DateTimeInterface $dataEntregaFinal): self
    {
        $this->dataEntregaFinal = $dataEntregaFinal;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function setDataInicial(?\DateTimeInterface $dataInicial): self
    {
        $this->dataInicial = $dataInicial;

        return $this;
    }
    public function getDataInicial(): ?\DateTimeInterface
    {
        return $this->dataInicial;
    }

    #[ArrayShape(["Id" => "int", "nome" => "string", "descricao" => "string", "situacao" =>"string", "cpf_cnpj" => "string", "dataEntregaFinal" => "\DateTimeInterface","dataInicial" => "\DateTimeInterface","dataFimPrevisto" => "\DateTimeInterface", "dataIniPrevisto" => "\DateTimeInterface" ])]
    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "nome" => $this->getNomeProjeto(),
            "descricao" => $this->getDescricao(),
            "situacao" => $this->getSituacao(),
            "cpf_cnpj" => $this->getCpfCnpj(),
            "dataEntregaFinal" => $this->getDataEntregaFinal(),
            "dataInicial" => $this->getDataInicial(),
            "dataFimPrevisto" => $this->getDataFimPrevisto(),
            "dataIniPrevisto" => $this->getDataIniPrevisto(),
        ];
    }
}
