<?php

namespace App\Entity;

use App\Repository\TarefaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Internal\TentativeType;

/**
 * Classe responsável por gerenciar a tabela de Tarefa
 * @author Guilherme Correia
 */
#[ORM\Entity(repositoryClass: TarefaRepository::class)]
class Tarefa implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    public ?int $id = null;

    #[ORM\ManyToOne]
    public ?Projeto $idProjeto = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $prioridade = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $situacao = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $nomeTarefa = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $nome = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $descricao = null;

    #[ORM\Column(nullable: true)]
    public ?float $tempoEstimado = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $dataIni = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $dataFim = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    public ?string $documentacao = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $tipoTarefa = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public ?Funcionario $idFuncionario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProjeto(): ?Projeto
    {
        return $this->idProjeto;
    }

    public function setIdProjeto(?Projeto $idProjeto): self
    {
        $this->idProjeto = $idProjeto;

        return $this;
    }

    public function getPrioridade(): ?string
    {
        return $this->prioridade;
    }

    public function setPrioridade(?string $prioridade): self
    {
        $this->prioridade = $prioridade;

        return $this;
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

    public function getNomeTarefa(): ?string
    {
        return $this->nomeTarefa;
    }

    public function setNomeTarefa(?string $nomeTarefa): self
    {
        $this->nomeTarefa = $nomeTarefa;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

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

    public function getTempoEstimado(): ?float
    {
        return $this->tempoEstimado;
    }

    public function setTempoEstimado(?float $tempoEstimado): self
    {
        $this->tempoEstimado = $tempoEstimado;

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

    public function getDocumentacao(): ?string
    {
        return $this->documentacao;
    }

    public function setDocumentacao(?string $documentacao): self
    {
        $this->documentacao = $documentacao;

        return $this;
    }

    public function getTipoTarefa(): ?string
    {
        return $this->tipoTarefa;
    }

    public function setTipoTarefa(?string $tipoTarefa): self
    {
        $this->tipoTarefa = $tipoTarefa;

        return $this;
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

    public function jsonSerialize(): array
    {
        return[
            "Id" => $this->getId(),
            "idProjeto" => $this->getIdProjeto(),
            "prioridade" => $this->getPrioridade(),
            "situacao" => $this->getSituacao(),
            "nomeTarefa" => $this->getNomeTarefa(),
            "nome" => $this->getNome(),
            "descricao" => $this->getDescricao(),
            "tempoEstimado" => $this->getTempoEstimado(),
            "dataIni" => $this->getDataIni(),
            "dataFim" => $this->getDataFim(),
            "documentacao" => $this->getDocumentacao(),
            "tipoTarefa" => $this->getTipoTarefa(),
            "idFuncionario" => $this->getIdFuncionario()
        ];
    }
}
