<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $numeroDeRue = null;

    #[ORM\Column(length: 51, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nomRue = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $complement = null;

    /**
     * @var Collection<int, AffiliationAdresse>
     */
    #[ORM\OneToMany(targetEntity: AffiliationAdresse::class, mappedBy: 'adresse')]
    private Collection $affiliationAdresses;

    /**
     * @var Collection<int, Fournisseur>
     */
    #[ORM\OneToMany(targetEntity: Fournisseur::class, mappedBy: 'adresse')]
    private Collection $fournisseurs;

    public function __construct()
    {
        $this->affiliationAdresses = new ArrayCollection();
        $this->fournisseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroDeRue(): ?string
    {
        return $this->numeroDeRue;
    }

    public function setNumeroDeRue(?string $numeroDeRue): static
    {
        $this->numeroDeRue = $numeroDeRue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getNomRue(): ?string
    {
        return $this->nomRue;
    }

    public function setNomRue(?string $nomRue): static
    {
        $this->nomRue = $nomRue;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): static
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * @return Collection<int, AffiliationAdresse>
     */
    public function getAffiliationAdresses(): Collection
    {
        return $this->affiliationAdresses;
    }

    public function addAffiliationAdress(AffiliationAdresse $affiliationAdress): static
    {
        if (!$this->affiliationAdresses->contains($affiliationAdress)) {
            $this->affiliationAdresses->add($affiliationAdress);
            $affiliationAdress->setAdresse($this);
        }

        return $this;
    }

    public function removeAffiliationAdress(AffiliationAdresse $affiliationAdress): static
    {
        if ($this->affiliationAdresses->removeElement($affiliationAdress)) {
            // set the owning side to null (unless already changed)
            if ($affiliationAdress->getAdresse() === $this) {
                $affiliationAdress->setAdresse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getFournisseurs(): Collection
    {
        return $this->fournisseurs;
    }

    public function addFournisseur(Fournisseur $fournisseur): static
    {
        if (!$this->fournisseurs->contains($fournisseur)) {
            $this->fournisseurs->add($fournisseur);
            $fournisseur->setAdresse($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        if ($this->fournisseurs->removeElement($fournisseur)) {
            // set the owning side to null (unless already changed)
            if ($fournisseur->getAdresse() === $this) {
                $fournisseur->setAdresse(null);
            }
        }

        return $this;
    }
}
