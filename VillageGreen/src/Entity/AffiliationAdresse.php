<?php

namespace App\Entity;

use App\Repository\AffiliationAdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffiliationAdresseRepository::class)]
class AffiliationAdresse
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Utilisateur::class,inversedBy: 'affiliationAdresses')]
    #[ORM\JoinColumn(name: "refClient", referencedColumnName: "id", nullable: false)]
    private ?Utilisateur $client = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Adresse::class,inversedBy: 'affiliationAdresses')]
    #[ORM\JoinColumn(name: "adresseId", referencedColumnName: "id", nullable: false)]
    private ?Adresse $adresse = null;

    #[ORM\Id]
    #[ORM\Column(length: 20)]
    #[ORM\JoinColumn(name: "type", referencedColumnName: "id", nullable: false)]
    private ?string $type = null;

    public function getClient(): ?Utilisateur
    {
        return $this->client;
    }

    public function setClient(?Utilisateur $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
