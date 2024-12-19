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

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Emprunt>
     */
    #[ORM\OneToMany(targetEntity: Emprunt::class, mappedBy: 'periodicite', orphanRemoval: true)]
    private Collection $emprunts;

        /**
     * @var Collection<int, Abonnement>
     */
    #[ORM\OneToMany(targetEntity: Abonnement::class, mappedBy: 'periodicite', orphanRemoval: true)]
    private Collection $abonnements;

    /**
     * @var Collection<int, Contrat>
     */
    #[ORM\OneToMany(targetEntity: Contrat::class, mappedBy: 'periodicite')]
    private Collection $contrats;

    public function __construct()
    {
        $this->emprunts = new ArrayCollection();
        $this->contrats = new ArrayCollection();
        $this->contratAssuranceVies = new ArrayCollection();
        $this->abonnements = new ArrayCollection();
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
            $emprunt->setPeriodicite($this);
        }

        return $this;
    }
    public function removeEmprunt(Emprunt $emprunt): static
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getPeriodicite() === $this) {
                $emprunt->setPeriodicite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contrat>
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): static
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats->add($contrat);
            $contrat->setPeriodicite($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): static
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getPeriodicite() === $this) {
                $contrat->setPeriodicite(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, ContratAssuranceVies>
     */
    public function getContratAssuranceVies(): Collection
    {
        return $this->contratAssuranceVies;
    }

    public function addContratAssuranceVies(ContratAssuranceVies $contratAssuranceVies): static
    {
        if (!$this->contratAssuranceVies->contains($contratAssuranceVies)) {
            $this->contratAssuranceVies->add($contratAssuranceVies);
            $contratAssuranceVies->setPeriodicite($this);
        }

        return $this;
    }

    public function removeContratAssuranceVies(ContratAssuranceVies $contratAssuranceVies): static
    {
        if ($this->contratAssuranceVies->removeElement($contratAssuranceVies)) {
            // set the owning side to null (unless already changed)
            if ($contratAssuranceVies->getPeriodicite() === $this) {
                $contratAssuranceVies->setPeriodicite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): static
    {
        if (!$this->abonnements->contains($abonnements)) {
            $this->abonnements->add($abonnement);
            $abonnement->setPeriodicite($this);
        }

        return $this;
    }
    public function removeAbonnement(Abonnement $abonnement): static
    {
        if ($this->abonnements->removeElement($abonnement)) {
            // set the owning side to null (unless already changed)
            if ($abonnement->getPeriodicite() === $this) {
                $abonnement->setPeriodicite(null);
            }
        }

        return $this;
    }

}
