<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomRubrique = null;

    #[ORM\Column(length: 50)]
    private ?string $imageRubrique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRubrique(): ?string
    {
        return $this->nomRubrique;
    }

    public function setNomRubrique(string $nomRubrique): static
    {
        $this->nomRubrique = $nomRubrique;

        return $this;
    }

    public function getImageRubrique(): ?string
    {
        return $this->imageRubrique;
    }

    public function setImageRubrique(string $imageRubrique): static
    {
        $this->imageRubrique = $imageRubrique;

        return $this;
    }
}
