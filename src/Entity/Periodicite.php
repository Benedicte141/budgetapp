<?php

namespace App\Entity;

use App\Repository\PeriodiciteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeriodiciteRepository::class)]
class Periodicite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, ContratAssuranceVie>
     */
    #[ORM\OneToMany(targetEntity: ContratAssuranceVie::class, mappedBy: 'periodicite')]
    private Collection $contratAssuranceVies;

    public function __construct()
    {
        $this->contratAssuranceVies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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
            $contratAssuranceVy->setPeriodicite($this);
        }

        return $this;
    }

    public function removeContratAssuranceVy(ContratAssuranceVie $contratAssuranceVy): static
    {
        if ($this->contratAssuranceVies->removeElement($contratAssuranceVy)) {
            // set the owning side to null (unless already changed)
            if ($contratAssuranceVy->getPeriodicite() === $this) {
                $contratAssuranceVy->setPeriodicite(null);
            }
        }

        return $this;
    }
}
