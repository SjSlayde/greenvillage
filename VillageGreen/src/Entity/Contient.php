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

    public function setPrixUnitaireHT(): static
    {
        // calcule du prix unitaire grace au prix d'achat du produit et le coefficient de vente du client
        $this->prixUnitaireHT = $this->getProduit()->getPrixAchatProduit() * ( 1 + $this->getCommande()->getRefClient()->getCoefficientVente() / 100);
        return $this;
    }

    public function getArticleTotalHt(): ?string
    {
        return $this->articleTotalHt;
    }

    public function setArticleTotalHt(): static
    {
        $this->articleTotalHt = $this->getQuantite() * $this->getPrixUnitaireHT();

        return $this;
    }

    public function getTVA(): ?string
    {
        return $this->TVA;
    }

    public function setTVA(): static
    {
        $this->TVA = $this->getArticleTotalHt() * 0.20;

        return $this;
    }

    public function getArticleTotalTtc(): ?string
    {
        return $this->articleTotalTtc;
    }

    public function setArticleTotalTtc(): static
    {
        $this->articleTotalTtc = $this->getArticleTotalHt() + $this->getTVA();

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

    public function setTotalContient(): void
    {
        $this->setPrixUnitaireHT();
        $this->setArticleTotalHt();
        $this->setTVA();
        $this->setArticleTotalTtc();

    }
}
