<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 14, nullable: true)]
    private ?string $telDomicile = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $telPortable = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $telJob = null;

    #[ORM\OneToMany(targetEntity: Proprietaire::class, mappedBy: 'contact')]
    private Collection $proprietaires;

    public function __construct()
    {
        $this->proprietaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelDomicile(): ?string
    {
        return $this->telDomicile;
    }

    public function setTelDomicile(?string $telDomicile): static
    {
        $this->telDomicile = $telDomicile;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->telPortable;
    }

    public function setTelPortable(?string $telPortable): static
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    public function getTelJob(): ?string
    {
        return $this->telJob;
    }

    public function setTelJob(?string $telJob): static
    {
        $this->telJob = $telJob;

        return $this;
    }

    /**
     * @return Collection<int, Proprietaire>
     */
    public function getProprietaires(): Collection
    {
        return $this->proprietaires;
    }

    public function addProprietaire(Proprietaire $proprietaire): static
    {
        if (!$this->proprietaires->contains($proprietaire)) {
            $this->proprietaires->add($proprietaire);
            $proprietaire->setContact($this);
        }

        return $this;
    }

    public function removeProprietaire(Proprietaire $proprietaire): static
    {
        if ($this->proprietaires->removeElement($proprietaire)) {
            // set the owning side to null (unless already changed)
            if ($proprietaire->getContact() === $this) {
                $proprietaire->setContact(null);
            }
        }

        return $this;
    }
}
