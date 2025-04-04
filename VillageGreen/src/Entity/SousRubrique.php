<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SousRubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousRubriqueRepository::class)]
#[ApiResource]
class SousRubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomSousRubrique = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $imageSousRubrique = null;

    #[ORM\ManyToOne(inversedBy: 'sousRubriques')]
    private ?Rubrique $Rubrique = null;

    /**
     * @var Collection<int, Avoir>
     */
    #[ORM\OneToMany(targetEntity: Avoir::class, mappedBy: 'sousRubrique')]
    private Collection $avoirs;



    public function __construct()
    {
        $this->idRubrique = new ArrayCollection();
        $this->avoirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSousRubrique(): ?string
    {
        return $this->nomSousRubrique;
    }

    public function setNomSousRubrique(string $nomSousRubrique): static
    {
        $this->nomSousRubrique = $nomSousRubrique;

        return $this;
    }

    public function getImageSousRubrique(): ?string
    {
        return $this->imageSousRubrique;
    }

    public function setImageSousRubrique(?string $imageSousRubrique): static
    {
        $this->imageSousRubrique = $imageSousRubrique;

        return $this;
    }

    public function getRubrique(): ?Rubrique
    {
        return $this->Rubrique;
    }

    public function setRubrique(?Rubrique $Rubrique): static
    {
        $this->Rubrique = $Rubrique;

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
            $avoir->setSousRubrique($this);
        }

        return $this;
    }

    public function removeAvoir(Avoir $avoir): static
    {
        if ($this->avoirs->removeElement($avoir)) {
            // set the owning side to null (unless already changed)
            if ($avoir->getSousRubrique() === $this) {
                $avoir->setSousRubrique(null);
            }
        }

        return $this;
    }


}
