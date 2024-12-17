<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numero_client = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_souscription = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objet = null;

    #[ORM\ManyToOne(inversedBy: 'abonnement')]
    private ?TypeAbonnement $type_abonnement = null;

    #[ORM\ManyToOne(inversedBy: 'abonnement')]
    private ?Periodicite $periodicite = null;

    #[ORM\ManyToOne(inversedBy: 'abonnements')]
    private ?Organisme $organisme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroClient(): ?string
    {
        return $this->numero_client;
    }

    public function setNumeroClient(string $numero_client): static
    {
        $this->numero_client = $numero_client;

        return $this;
    }

    public function getDateSouscription(): ?\DateTimeInterface
    {
        return $this->date_souscription;
    }

    public function setDateSouscription(\DateTimeInterface $date_souscription): static
    {
        $this->date_souscription = $date_souscription;

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

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getTypeAbonnement(): ?TypeAbonnement
    {
        return $this->type_abonnement;
    }

    public function setTypeAbonnement(?TypeAbonnement $type_abonnement): static
    {
        $this->type_abonnement = $type_abonnement;

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

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): static
    {
        $this->organisme = $organisme;

        return $this;
    }
}
