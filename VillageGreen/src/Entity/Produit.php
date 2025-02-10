<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomProduit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $prixAchatProduit = null;

    #[ORM\Column(length: 50)]
    private ?string $descriptionCourt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionLong = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nomImage = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column]
    private ?bool $actif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): static
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getPrixAchatProduit(): ?string
    {
        return $this->prixAchatProduit;
    }

    public function setPrixAchatProduit(string $prixAchatProduit): static
    {
        $this->prixAchatProduit = $prixAchatProduit;

        return $this;
    }

    public function getDescriptionCourt(): ?string
    {
        return $this->descriptionCourt;
    }

    public function setDescriptionCourt(string $descriptionCourt): static
    {
        $this->descriptionCourt = $descriptionCourt;

        return $this;
    }

    public function getDescriptionLong(): ?string
    {
        return $this->descriptionLong;
    }

    public function setDescriptionLong(?string $descriptionLong): static
    {
        $this->descriptionLong = $descriptionLong;

        return $this;
    }

    public function getNomImage(): ?string
    {
        return $this->nomImage;
    }

    public function setNomImage(?string $nomImage): static
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }
}
