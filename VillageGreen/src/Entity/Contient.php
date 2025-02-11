<?php

namespace App\Entity;

use App\Repository\ContientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContientRepository::class)]
#[ORM\Table(name: "contient")]
class Contient
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Produit::class,inversedBy: 'contients')]
    #[ORM\JoinColumn(name: "produit_id", referencedColumnName: "id", nullable: false)]
    private ?Produit $produit = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Commande::class,inversedBy: 'contients')]
    #[ORM\JoinColumn(name: "commande_id", referencedColumnName: "id", nullable: false)]
    private ?Commande $commande = null;


    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $prixUnitaireHT = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $articleTotalHt = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $TVA = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $articleTotalTtc = null;

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaireHT(): ?string
    {
        return $this->prixUnitaireHT;
    }

    public function setPrixUnitaireHT(string $prixUnitaireHT): static
    {
        $this->prixUnitaireHT = $prixUnitaireHT;

        return $this;
    }

    public function getArticleTotalHt(): ?string
    {
        return $this->articleTotalHt;
    }

    public function setArticleTotalHt(string $articleTotalHt): static
    {
        $this->articleTotalHt = $articleTotalHt;

        return $this;
    }

    public function getTVA(): ?string
    {
        return $this->TVA;
    }

    public function setTVA(string $TVA): static
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getArticleTotalTtc(): ?string
    {
        return $this->articleTotalTtc;
    }

    public function setArticleTotalTtc(string $articleTotalTtc): static
    {
        $this->articleTotalTtc = $articleTotalTtc;

        return $this;
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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}
