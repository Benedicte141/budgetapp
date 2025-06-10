<?php

namespace App\Entity;

use App\Repository\BanqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanqueRepository::class)]
class Banque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private ?string $cp = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    /**
     * @var Collection<int, Compte>
     */
    #[ORM\OneToMany(targetEntity: Compte::class, mappedBy: 'banque')]
    private Collection $comptes;

    /**
     * @var Collection<int, Emprunt>
     */
    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'banque', orphanRemoval: true)]
    private Collection $emprunts;

    #[ORM\ManyToOne(inversedBy: 'banques')]
    private ?BankApi $bank_api = null;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->emprunts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function isActive(): bool
{
    return $this->active;
}

public function setActive(bool $active): self
{
    $this->active = $active;
    return $this;
}

    /**
     * @return Collection<int, Compte>
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): static
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes->add($compte);
            $compte->setBanque($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): static
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getBanque() === $this) {
                $compte->setBanque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Emprunt>
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): static
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts->add($emprunt);
            $emprunt->setBanque($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getBanque() === $this) {
                $emprunt->setBanque(null);
            }
        }

        return $this;
    }

    public function getBankApi(): ?BankApi
    {
        return $this->bank_api;
    }

    public function setBankApi(?BankApi $bank_api): static
    {
        $this->bank_api = $bank_api;

        return $this;
    }
}
