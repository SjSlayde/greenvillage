<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $transporteur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $urlSuivi = null;

    /**
     * @var Collection<int, DetailLiv>
     */
    #[ORM\OneToMany(targetEntity: DetailLiv::class, mappedBy: 'livraison')]
    private Collection $detailLivs;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    private ?Commande $commande = null;

    public function __construct()
    {
        $this->detailLivs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getTransporteur(): ?string
    {
        return $this->transporteur;
    }

    public function setTransporteur(?string $transporteur): static
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getUrlSuivi(): ?string
    {
        return $this->urlSuivi;
    }

    public function setUrlSuivi(?string $urlSuivi): static
    {
        $this->urlSuivi = $urlSuivi;

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
            $detailLiv->setLivraison($this);
        }

        return $this;
    }

    public function removeDetailLiv(DetailLiv $detailLiv): static
    {
        if ($this->detailLivs->removeElement($detailLiv)) {
            // set the owning side to null (unless already changed)
            if ($detailLiv->getLivraison() === $this) {
                $detailLiv->setLivraison(null);
            }
        }

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
