<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montantInitial = null;

    #[ORM\Column]
    private ?float $montantEcheance = null;

    #[ORM\Column]
    private ?float $coutInteret = null;

    #[ORM\Column(nullable: true)]
    private ?float $montantRestDu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column]
    private ?float $taux = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Periodicite $periodicite = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeEmprunt $typeEmprunt = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Banque $banque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantInitial(): ?float
    {
        return $this->montantInitial;
    }

    public function setMontantInitial(float $montantInitial): static
    {
        $this->montantInitial = $montantInitial;

        return $this;
    }

    public function getMontantEcheance(): ?float
    {
        return $this->montantEcheance;
    }

    public function setMontantEcheance(float $montantEcheance): static
    {
        $this->montantEcheance = $montantEcheance;

        return $this;
    }

    public function getCoutInteret(): ?float
    {
        return $this->coutInteret;
    }

    public function setCoutInteret(float $coutInteret): static
    {
        $this->coutInteret = $coutInteret;

        return $this;
    }

    public function getMontantRestDu(): ?float
    {
        return $this->montantRestDu;
    }

    public function setMontantRestDu(?float $montantRestDu): static
    {
        $this->montantRestDu = $montantRestDu;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getTaux(): ?float
    {
        return $this->taux;
    }

    public function setTaux(float $taux): static
    {
        $this->taux = $taux;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

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

    public function getTypeEmprunt(): ?TypeEmprunt
    {
        return $this->typeEmprunt;
    }

    public function setTypeEmprunt(?TypeEmprunt $typeEmprunt): static
    {
        $this->typeEmprunt = $typeEmprunt;

        return $this;
    }

    public function getBanque(): ?Banque
    {
        return $this->banque;
    }

    public function setBanque(?Banque $banque): static
    {
        $this->banque = $banque;

        return $this;
    }
}
