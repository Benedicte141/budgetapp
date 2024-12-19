<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieRepository::class)]
class SousCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(nullable: true)]
    private ?float $budgetMensuel = null;

    #[ORM\Column(nullable: true)]
    private ?float $budgetAnnuel = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

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

    public function getBudgetMensuel(): ?float
    {
        return $this->budgetMensuel;
    }

    public function setBudgetMensuel(?float $budgetMensuel): static
    {
        $this->budgetMensuel = $budgetMensuel;

        return $this;
    }

    public function getBudgetAnnuel(): ?float
    {
        return $this->budgetAnnuel;
    }

    public function setBudgetAnnuel(?float $budgetAnnuel): static
    {
        $this->budgetAnnuel = $budgetAnnuel;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
