<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $compteAffaire = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $compteEvent = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $dernierEvent = null;

    #[ORM\OneToMany(targetEntity: Vehicule::class, mappedBy: 'compte')]
    private Collection $vehicules;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteAffaire(): ?string
    {
        return $this->compteAffaire;
    }

    public function setCompteAffaire(?string $compteAffaire): static
    {
        $this->compteAffaire = $compteAffaire;

        return $this;
    }

    public function getCompteEvent(): ?string
    {
        return $this->compteEvent;
    }

    public function setCompteEvent(?string $compteEvent): static
    {
        $this->compteEvent = $compteEvent;

        return $this;
    }

    public function getDernierEvent(): ?string
    {
        return $this->dernierEvent;
    }

    public function setDernierEvent(?string $dernierEvent): static
    {
        $this->dernierEvent = $dernierEvent;

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
            $vehicule->setCompte($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getCompte() === $this) {
                $vehicule->setCompte(null);
            }
        }

        return $this;
    }

}
