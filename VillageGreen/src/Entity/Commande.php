<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(length: 10)]
    private ?string $numFacturation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $commandeTotalHT = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $commandeTotalTTC = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $reduction = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $commandeTotalReduction = null;

    #[ORM\Column(length: 50)]
    private ?string $moyenPaiement = null;

    #[ORM\Column(length: 30)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?bool $paiementValide = null;

    /**
     * @var Collection<int, Contient>
     */
    #[ORM\OneToMany(targetEntity: Contient::class, mappedBy: 'commande')]
    private Collection $contients;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Utilisateur $refClient = null;

    /**
     * @var Collection<int, Livraison>
     */
    #[ORM\OneToMany(targetEntity: Livraison::class, mappedBy: 'commande')]
    private Collection $livraisons;

    public function __construct()
    {
        $this->contients = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(): void
    {
        $this->dateCommande = new \DateTimeImmutable();
    }

    public function getNumFacturation(): ?string
    {
        return $this->numFacturation;
    }

    public function setNumFacturation(string $numFacturation): static
    {
        $this->numFacturation = $numFacturation;

        return $this;
    }

    public function getCommandeTotalHT(): ?string
    {
        return $this->commandeTotalHT;
    }

    public function setCommandeTotalHT(): static
    {

        // recuperation des entités contient (details de la Commande)
        $detailsCommandes = $this->getContients();

        // setting de la variable total 
        $total = 0.00;

        // boucle sur les details de la commande pour calculer le total HT
        foreach ($detailsCommandes as $detailCommande) {
            $total += $detailCommande->getArticleTotalHt();
        }

        $this->commandeTotalHT = $total;

        return $this;
    }

    public function getCommandeTotalTTC(): ?string
    {
        return $this->commandeTotalTTC;
    }

    public function setCommandeTotalTTC(): static
    {
        // recuperation des entités contient (details de la Commande)
        $detailsCommande = $this->getContients();

        // setting de la variable total 
        $total = 0.00;

        // boucle sur les details de la commande pour calculer le total TTC
        foreach ($detailsCommande as $detailCommande) {
            $total += $detailCommande->getArticleTotalTtc();
        }

        $this->commandeTotalTTC = $total;

        return $this;
    }

    public function getReduction(): ?string
    {
        return $this->reduction;
    }

    public function setReduction(): static
    {
        // calcul du montant de la reduction
        $this->reduction = $this->getCommandeTotalTTC() - $this->getCommandeTotalTTC() / (1 + $this->getRefClient()->getCoefficientReduction() / 100);

        return $this;
    }

    public function getCommandeTotalReduction(): ?string
    {
        return $this->commandeTotalReduction;
    }

    public function setCommandeTotalReduction(): static
    {

        // Setting de la variable coefReduction grace au getter de la refClient
        $coefReduction = $this->getRefClient()->getCoefficientReduction();

        // Application de la reduction si elle est superieur a 0
        if ($coefReduction > 0){
            $this->commandeTotalReduction = $this->getCommandeTotalTTC() * (1 - $coefReduction / 100);
        } else {
            $this->commandeTotalReduction = $this->getCommandeTotalTTC();
        }

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(string $moyenPaiement): static
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function isPaiementValide(): ?bool
    {
        return $this->paiementValide;
    }

    public function setPaiementValide(bool $paiementValide): static
    {
        $this->paiementValide = $paiementValide;

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
            $contient->setCommande($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): static
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getCommande() === $this) {
                $contient->setCommande(null);
            }
        }

        return $this;
    }

    public function getRefClient(): ?Utilisateur
    {
        return $this->refClient;
    }

    public function setRefClient(?Utilisateur $refClient): static
    {
        $this->refClient = $refClient;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons->add($livraison);
            $livraison->setCommande($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getCommande() === $this) {
                $livraison->setCommande(null);
            }
        }

        return $this;
    }

    public function setTotalCommande(): void
    {
        $this->setCommandeTotalHT();
        $this->setCommandeTotalTTC();
        $this->setReduction();
        $this->setCommandeTotalReduction();
    }
}
