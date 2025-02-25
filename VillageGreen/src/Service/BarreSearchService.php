<?php 

namespace App\Service;

use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;

class BarreSearchService
{
    // Déclaration des propriétés pour stocker les repositories
    private $produitRepo;
    private $sousRubriqueRepo;

    // Constructeur pour injecter les repositories produit et sousRubrique
    public function __construct(ProduitRepository $produitRepo,SousRubriqueRepository $sousRubriqueRepo)
    {
        // Initialisation des repositories
        $this->produitRepo = $produitRepo;
        $this->sousRubriqueRepo = $sousRubriqueRepo;
    }

    /**
     * Méthode principale de recherche qui tente de rechercher d'abord par produit,
     * puis par sousRubrique, et retourne le résultat
     * 
     * @param string $recherche - Terme de recherche
     * @return array - Résultat de la recherche
     */
    public function search($recherche): array
    {
        // Recherche dans les produits d'abord
        if ($this->SearchProduit($recherche) != null) {
            $result = $this->SearchProduit($recherche);  // Si un plat est trouvé, on retourne ce résultat
        } 
        // Si aucun produit n'est trouvé, on recherche dans les sousRubriques
        elseif ($this->SearchSousRubrique($recherche) != null) {
            $result = $this->SearchSousRubrique($recherche);  // Si une sousRubrique est trouvée, on retourne ce résultat
        } 
        // Si rien n'est trouvé dans les produits ni les sousRubriques, on retourne un tableau vide
        else {
            $result = [];
        }

        return $result;
    }

    /**
     * Recherche parmi les produits si le terme de recherche correspond à leur libellé
     * 
     * @param string $recherche - Terme de recherche
     * @return array - Liste des produits correspondants
     */
    public function SearchProduit($recherche): array
    {
        // Récupère tous les produits
        $produits = $this->produitRepo->findAll();
        $produitrecherche = [];  // Tableau pour stocker les résultats

        // Parcourt chaque produit pour vérifier s'il contient le terme de recherche
        foreach ($produits as $produit) {
            if (str_contains(strtolower($produit->getNomProduit()), $recherche) or str_contains(strtolower($produit->getDescriptionLong()), $recherche) or str_contains(strtolower($produit->getDescriptionCourt()), $recherche)) {
                // Ajoute le produit dans le tableau des résultats si le terme de recherche est trouvé
                array_push($produitrecherche, $produit);
            }
        }
        return $produitrecherche;  // Retourne les produits correspondants
    }

    /**
     * Recherche parmi les sousRubriques si le terme de recherche correspond à leur libellé
     * 
     * @param string $recherche - Terme de recherche
     * @return array - Liste des sousRubriques correspondantes
     */
    public function SearchSousRubrique($recherche): array
    {
        // Récupère toutes les sousRubriques
        $sousRubriques = $this->sousRubriqueRepo->findAll();
        $sousRubriquerecherche = [];  // Tableau pour stocker les résultats

        // Parcourt chaque sousRubrique pour vérifier si elle contient le terme de recherche
        foreach ($sousRubriques as $sousRubrique) {
            if (str_contains(strtolower($sousRubrique->getNomSousRubrique()), $recherche) or str_contains(strtolower($sousRubrique->getRubrique()->getNomRubrique()), $recherche)) {
                // Ajoute la sousRubrique dans le tableau des résultats si le terme de recherche est trouvé
                array_push($sousRubriquerecherche, $sousRubrique);
            }
        }

        return $sousRubriquerecherche;  // Retourne les sousRubriques correspondantes
    }
}