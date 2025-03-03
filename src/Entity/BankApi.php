<?php

namespace App\Entity;

use App\Repository\BankApiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BankApiRepository::class)]
class BankApi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 15)]
    private ?string $version = null;

    #[ORM\Column]
    private array $fieldMapping = [];

    /**
     * @var Collection<int, Banque>
     */
    #[ORM\OneToMany(targetEntity: Banque::class, mappedBy: 'bank_api')]
    private Collection $banques;

    public function __construct()
    {
        $this->banques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getFieldMapping(): array
    {
        return $this->fieldMapping;
    }

    public function setFieldMapping(array $fieldMapping): static
    {
        $this->fieldMapping = $fieldMapping;

        return $this;
    }

    /**
     * @return Collection<int, Banque>
     */
    public function getBanques(): Collection
    {
        return $this->banques;
    }

    public function addBanque(Banque $banque): static
    {
        if (!$this->banques->contains($banque)) {
            $this->banques->add($banque);
            $banque->setBankApi($this);
        }

        return $this;
    }

    public function removeBanque(Banque $banque): static
    {
        if ($this->banques->removeElement($banque)) {
            // set the owning side to null (unless already changed)
            if ($banque->getBankApi() === $this) {
                $banque->setBankApi(null);
            }
        }

        return $this;
    }
}
