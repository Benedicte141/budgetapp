<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sous = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_couverture = null;

    #[ORM\Column(length: 255)]
    private ?string $num_client = null;

    #[ORM\ManyToOne(inversedBy: 'contrats')]
    private ?Periodicite $periodicite = null;

    #[ORM\ManyToOne(inversedBy: 'contrats')]
    private ?Compagnie $compagnie = null;

    #[ORM\ManyToOne(inversedBy: 'contrats')]
    private ?TypeContrat $typeContrat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSous(): ?\DateTimeInterface
    {
        return $this->date_sous;
    }

    public function setDateSous(\DateTimeInterface $date_sous): static
    {
        $this->date_sous = $date_sous;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getLibelleCouverture(): ?string
    {
        return $this->libelle_couverture;
    }

    public function setLibelleCouverture(string $libelle_couverture): static
    {
        $this->libelle_couverture = $libelle_couverture;

        return $this;
    }

    public function getNumClient(): ?string
    {
        return $this->num_client;
    }

    public function setNumClient(string $num_client): static
    {
        $this->num_client = $num_client;

        return $this;
    }

    public function getPeriodicite(): ?Periodicite
    {
        return $this->periodicite;
    }

    public function setPeriodicite(?Periodicite $periodicite): static
    {
        $this->periodicite = $periodicite;

        return $this;
    }

    public function getCompagnie(): ?Compagnie
    {
        return $this->compagnie;
    }

    public function setCompagnie(?Compagnie $compagnie): static
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    public function getTypeContrat(): ?TypeContrat
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?TypeContrat $typeContrat): static
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }
}
