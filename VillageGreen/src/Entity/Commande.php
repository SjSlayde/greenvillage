<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(length: 10)]
    private ?string $numFacturation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $commandeTotalHT = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $commandeTotalTTC = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $reduction = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $commandeTotalReduction = null;

    #[ORM\Column(length: 50)]
    private ?string $moyenPaiement = null;

    #[ORM\Column(length: 30)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?bool $paiementValide = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getNumFacturation(): ?string
    {
        return $this->numFacturation;
    }

    public function setNumFacturation(string $numFacturation): static
    {
        $this->numFacturation = $numFacturation;

        return $this;
    }

    public function getCommandeTotalHT(): ?string
    {
        return $this->commandeTotalHT;
    }

    public function setCommandeTotalHT(string $commandeTotalHT): static
    {
        $this->commandeTotalHT = $commandeTotalHT;

        return $this;
    }

    public function getCommandeTotalTTC(): ?string
    {
        return $this->commandeTotalTTC;
    }

    public function setCommandeTotalTTC(string $commandeTotalTTC): static
    {
        $this->commandeTotalTTC = $commandeTotalTTC;

        return $this;
    }

    public function getReduction(): ?string
    {
        return $this->reduction;
    }

    public function setReduction(string $reduction): static
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getCommandeTotalReduction(): ?string
    {
        return $this->commandeTotalReduction;
    }

    public function setCommandeTotalReduction(string $commandeTotalReduction): static
    {
        $this->commandeTotalReduction = $commandeTotalReduction;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(string $moyenPaiement): static
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function isPaiementValide(): ?bool
    {
        return $this->paiementValide;
    }

    public function setPaiementValide(bool $paiementValide): static
    {
        $this->paiementValide = $paiementValide;

        return $this;
    }
}
