<?php

namespace App\Entity;

use App\Repository\FuncionarioRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: FuncionarioRepository::class)]
class Funcionario implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id;

    #[ORM\Column(type: 'string', length: 100)]
    public ?string $nomeFuncionario;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public ?string $emailFuncionario;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public ?string $senha;

    #[ORM\Column(type: 'float', nullable: true)]
    public ?float $cargaHorariaSemanal;

    #[ORM\Column(type: 'blob', nullable: true)]
    public $imagemPerfil;

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

    public function getImagemPerfil()
    {
        return $this->imagemPerfil;
    }

    public function setImagemPerfil($imagemPerfil): self
    {
        $this->imagemPerfil = $imagemPerfil;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nomeFuncionario" => $this->getNomeFuncionario(),
            "emailFuncionario" => $this->getEmailFuncionario(),
            "senha" => $this->getSenha(),
            "cargaHorariaSemanal" => $this->getCargaHorariaSemanal(),
           // "imagemPerfil" => $this->getImagemPerfil()
        ];
    }
}
