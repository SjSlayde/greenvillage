<?php

namespace App\Entity;

use App\Repository\DetailLivRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailLivRepository::class)]
class DetailLiv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivs')]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivs')]
    private ?Livraison $livraison = null;

    #[ORM\Column]
    private ?int $quantiteLiv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function getQuantiteLiv(): ?int
    {
        return $this->quantiteLiv;
    }

    public function setQuantiteLiv(int $quantiteLiv): static
    {
        $this->quantiteLiv = $quantiteLiv;

        return $this;
    }
}
