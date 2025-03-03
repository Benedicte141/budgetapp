<?php

namespace App\Entity;

use App\Repository\ImportErrorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImportErrorRepository::class)]
class ImportError
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $errorType = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    #[ORM\Column(length: 255)]
    private ?string $rawData = null;

    #[ORM\ManyToOne(inversedBy: 'importErrors')]
    private ?Compte $compte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getErrorType(): ?string
    {
        return $this->errorType;
    }

    public function setErrorType(string $errorType): static
    {
        $this->errorType = $errorType;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getRawData(): ?string
    {
        return $this->rawData;
    }

    public function setRawData(string $rawData): static
    {
        $this->rawData = $rawData;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): static
    {
        $this->compte = $compte;

        return $this;
    }
}
