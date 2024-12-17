<?php

namespace App\Entity;

use App\Repository\ContratAssuranceVieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratAssuranceVieRepository::class)]
class ContratAssuranceVie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $solde = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $montantValueLatente = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $totalInvestit = null;

    #[ORM\Column(length: 50)]
    private ?string $numero = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $totalRachete = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOuverture = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2, nullable: true)]
    private ?string $montantVersementLibre = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'contratAssuranceVies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CompagnieAssurance $compagnie_assurance = null;

    #[ORM\ManyToOne(inversedBy: 'contratAssuranceVies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModeGestion $mode_gestion = null;

    #[ORM\ManyToOne(inversedBy: 'contratAssuranceVies')]
    private ?Periodicite $periodicite = null;

    public function __construct()
    {
        $this->operations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getMontantValueLatente(): ?string
    {
        return $this->montantValueLatente;
    }

    public function setMontantValueLatente(string $montantValueLatente): static
    {
        $this->montantValueLatente = $montantValueLatente;

        return $this;
    }

    public function getTotalInvestit(): ?string
    {
        return $this->totalInvestit;
    }

    public function setTotalInvestit(string $totalInvestit): static
    {
        $this->totalInvestit = $totalInvestit;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTotalRachete(): ?string
    {
        return $this->totalRachete;
    }

    public function setTotalRachete(string $totalRachete): static
    {
        $this->totalRachete = $totalRachete;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->dateOuverture;
    }

    public function setDateOuverture(\DateTimeInterface $dateOuverture): static
    {
        $this->dateOuverture = $dateOuverture;

        return $this;
    }

    public function getMontantVersementLibre(): ?string
    {
        return $this->montantVersementLibre;
    }

    public function setMontantVersementLibre(string $montantVersementLibre): static
    {
        $this->montantVersementLibre = $montantVersementLibre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCompagnieAssurance(): ?CompagnieAssurance
    {
        return $this->compagnie_assurance;
    }

    public function setCompagnieAssurance(?CompagnieAssurance $compagnie_assurance): static
    {
        $this->compagnie_assurance = $compagnie_assurance;

        return $this;
    }

    public function getModeGestion(): ?ModeGestion
    {
        return $this->mode_gestion;
    }

    public function setModeGestion(?ModeGestion $mode_gestion): static
    {
        $this->mode_gestion = $mode_gestion;

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

   

}
