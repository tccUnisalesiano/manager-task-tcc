<?php

namespace App\Entity;

use App\Repository\AtividadeRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Internal\TentativeType;

#[ORM\Entity(repositoryClass: AtividadeRepository::class)]
class Atividade implements \JsonSerializable

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $nome = null;

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
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

    public function jsonSerialize(): mixed
    {
        return[
            "Id" => $this->getId(),
            "nome" => $this->getNome()
        ];
    }
}
