<?php

namespace App\Entity;

use App\Repository\CompagnieAssuranceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompagnieAssuranceRepository::class)]
class CompagnieAssurance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 5)]
    private ?string $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    /**
     * @var Collection<int, ContratAssuranceVie>
     */
    #[ORM\OneToMany(targetEntity: ContratAssuranceVie::class, mappedBy: 'compagnie_assurance', orphanRemoval: true)]
    private Collection $contratAssuranceVies;

    public function __construct()
    {
        $this->contratAssuranceVies = new ArrayCollection();
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

    /**
     * @return Collection<int, ContratAssuranceVie>
     */
    public function getContratAssuranceVies(): Collection
    {
        return $this->contratAssuranceVies;
    }

    public function addContratAssuranceVy(ContratAssuranceVie $contratAssuranceVy): static
    {
        if (!$this->contratAssuranceVies->contains($contratAssuranceVy)) {
            $this->contratAssuranceVies->add($contratAssuranceVy);
            $contratAssuranceVy->setCompagnieAssurance($this);
        }

        return $this;
    }

    public function removeContratAssuranceVy(ContratAssuranceVie $contratAssuranceVy): static
    {
        if ($this->contratAssuranceVies->removeElement($contratAssuranceVy)) {
            // set the owning side to null (unless already changed)
            if ($contratAssuranceVy->getCompagnieAssurance() === $this) {
                $contratAssuranceVy->setCompagnieAssurance(null);
            }
        }

        return $this;
    }
}
