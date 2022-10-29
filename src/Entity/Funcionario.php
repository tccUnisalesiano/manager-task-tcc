<?php

namespace App\Entity;

use App\Repository\FuncionarioRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Classe responsável por gerenciar o funcionario
 * @author Guilherme Correia
 */
#[ORM\Entity(repositoryClass: FuncionarioRepository::class)]
#[Vich\Uploadable]
class Funcionario implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $nomeFuncionario;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public ?string $emailFuncionario;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public ?string $senha;

    #[ORM\Column(type: 'float', nullable: true)]
    public ?float $cargaHorariaSemanal;

    #[ORM\Column(type: 'boolean', nullable: true)]
    public ?bool $isAdmin;

    #[ORM\Column(nullable: true)]
    public ?bool $isAtivo = null;

    // imagem
    #[Vich\UploadableField(mapping: 'user', fileNameProperty: 'imageName')]
    public ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255 , nullable: true)]
    public ?string $imageName;

    #[ORM\Column(type: 'datetime')]
    public ?\DateTimeInterface $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeFuncionario(): ?string
    {
        return $this->nomeFuncionario;
    }

    public function setNomeFuncionario(string $nomeFuncionario): self
    {
        $this->nomeFuncionario = $nomeFuncionario;

        return $this;
    }

    public function getEmailFuncionario(): ?string
    {
        return $this->emailFuncionario;
    }

    public function setEmailFuncionario(?string $emailFuncionario): self
    {
        $this->emailFuncionario = $emailFuncionario;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getCargaHorariaSemanal(): ?float
    {
        return $this->cargaHorariaSemanal;
    }

    public function setCargaHorariaSemanal(?float $cargaHorariaSemanal): self
    {
        $this->cargaHorariaSemanal = $cargaHorariaSemanal;

        return $this;
    }


    public function getIsAdmin(): ?bool
    {
        return $this-> isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getIsAtivo(): ?bool
    {
        return $this->isAtivo;
    }

    public function setIsAtivo(?bool $isAtivo): self
    {
        $this->isAtivo = $isAtivo;

        return $this;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }


//    #[ArrayShape(["id" => "int|null", "nomeFuncionario" => "null|string", "emailFuncionario" => "null|string", "senha" => "null|string", "cargaHorariaSemanal" => "float|null", "isAdmin" => "bool|null", "isAtivo" => "bool|null"])]
    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "nomeFuncionario" => $this->getNomeFuncionario(),
            "emailFuncionario" => $this->getEmailFuncionario(),
            "senha" => $this->getSenha(),
            "cargaHorariaSemanal" => $this->getCargaHorariaSemanal(),
            "isAdmin" => $this->getIsAdmin(),
            "isAtivo" => $this->getIsAtivo(),
            "imageName" => $this->getImageName(),
            "imageFile" => $this->getImageFile()
        ];
    }
}