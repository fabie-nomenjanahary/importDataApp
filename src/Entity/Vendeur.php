<?php

namespace App\Entity;

use App\Repository\VendeurRepository;
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
}
