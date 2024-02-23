<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendeurRepository::class)]
class Vendeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $vendeurVO = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $vendeurVN = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $intermediaire = null;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'vendeur')]
    private Collection $vehicules;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVendeurVO(): ?string
    {
        return $this->vendeurVO;
    }

    public function setVendeurVO(?string $vendeurVO): static
    {
        $this->vendeurVO = $vendeurVO;

        return $this;
    }

    public function getVendeurVN(): ?string
    {
        return $this->vendeurVN;
    }

    public function setVendeurVN(?string $vendeurVN): static
    {
        $this->vendeurVN = $vendeurVN;

        return $this;
    }

    public function getIntermediaire(): ?string
    {
        return $this->intermediaire;
    }

    public function setIntermediaire(?string $intermediaire): static
    {
        $this->intermediaire = $intermediaire;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setVendeur($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getVendeur() === $this) {
                $vehicule->setVendeur(null);
            }
        }

        return $this;
    }
}
