<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $origineEvent = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEvent = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDernierEvent = null;

    #[ORM\ManyToOne(inversedBy: 'evenements', fetch: 'EAGER')]
    private ?Vehicule $vehicule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigineEvent(): ?string
    {
        return $this->origineEvent;
    }

    public function setOrigineEvent(?string $origineEvent): static
    {
        $this->origineEvent = $origineEvent;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(?\DateTimeInterface $dateEvent): static
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getDateDernierEvent(): ?\DateTimeInterface
    {
        return $this->dateDernierEvent;
    }

    public function setDateDernierEvent(?\DateTimeInterface $dateDernierEvent): static
    {
        $this->dateDernierEvent = $dateDernierEvent;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}
