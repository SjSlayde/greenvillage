<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Avoir>
     */
    #[ORM\OneToMany(targetEntity: Avoir::class, mappedBy: 'produit')]
    private Collection $avoirs;

    /**
     * @var Collection<int, Contient>
     */
    #[ORM\OneToMany(targetEntity: Contient::class, mappedBy: 'produit')]
    private Collection $contients;

    /**
     * @var Collection<int, DetailLiv>
     */
    #[ORM\OneToMany(targetEntity: DetailLiv::class, mappedBy: 'produit')]
    private Collection $detailLivs;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Fournisseur $fournisseur = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $refProduit = null;

    public function __construct()
    {
        $this->avoirs = new ArrayCollection();
        $this->contients = new ArrayCollection();
        $this->detailLivs = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Avoir>
     */
    public function getAvoirs(): Collection
    {
        return $this->avoirs;
    }

    public function addAvoir(Avoir $avoir): static
    {
        if (!$this->avoirs->contains($avoir)) {
            $this->avoirs->add($avoir);
            $avoir->setProduit($this);
        }

        return $this;
    }

    public function removeAvoir(Avoir $avoir): static
    {
        if ($this->avoirs->removeElement($avoir)) {
            // set the owning side to null (unless already changed)
            if ($avoir->getProduit() === $this) {
                $avoir->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contient>
     */
    public function getContients(): Collection
    {
        return $this->contients;
    }

    public function addContient(Contient $contient): static
    {
        if (!$this->contients->contains($contient)) {
            $this->contients->add($contient);
            $contient->setProduit($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): static
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getProduit() === $this) {
                $contient->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailLiv>
     */
    public function getDetailLivs(): Collection
    {
        return $this->detailLivs;
    }

    public function addDetailLiv(DetailLiv $detailLiv): static
    {
        if (!$this->detailLivs->contains($detailLiv)) {
            $this->detailLivs->add($detailLiv);
            $detailLiv->setProduit($this);
        }

        return $this;
    }

    public function removeDetailLiv(DetailLiv $detailLiv): static
    {
        if ($this->detailLivs->removeElement($detailLiv)) {
            // set the owning side to null (unless already changed)
            if ($detailLiv->getProduit() === $this) {
                $detailLiv->setProduit(null);
            }
        }

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getRefProduit(): ?string
    {
        return $this->refProduit;
    }

    public function setRefProduit(?string $refProduit): static
    {
        $this->refProduit = $refProduit;

        return $this;
    }

    public function getTotalQuantite(): int
    {
        $quantite = 0;
        foreach($this->contients as $contient){
            $quantite += $contient->getQuantite();
            };
    
        return $quantite;
    }
}
