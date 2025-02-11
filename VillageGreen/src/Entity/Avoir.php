<?php

namespace App\Entity;

use App\Repository\AvoirRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvoirRepository::class)]
#[ORM\Table(name: "avoir")]
class Avoir
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: "avoirs")]
    #[ORM\JoinColumn(name: "produit_id", referencedColumnName: "id", nullable: false)]
    private ?Produit $produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: SousRubrique::class, inversedBy: "avoirs")]
    #[ORM\JoinColumn(name: "sousRubrique_id", referencedColumnName: "id", nullable: false)]
    private ?SousRubrique $sousProduit = null;

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getSousProduit(): ?SousRubrique
    {
        return $this->sousProduit;
    }

    public function setSousProduit(?SousRubrique $sousProduit): static
    {
        $this->sousProduit = $sousProduit;

        return $this;
    }
}
