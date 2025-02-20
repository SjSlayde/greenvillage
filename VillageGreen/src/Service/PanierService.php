<?php

namespace App\Service;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

class PanierService
{
    private $requestStack;
    private $ProduitRepo;

    public function __construct(RequestStack $requestStack,ProduitRepository $ProduitRepo)
    {
        $this->requestStack = $requestStack; // Gère la requête HTTP, y compris la session
        $this->ProduitRepo= $ProduitRepo; // Repository pour accéder aux Produits
    }
   
        /**
     * Récupère le panier de la session sous forme de tableau associatif
     * contenant les identifiants des Produits et les quantités
     *
     * @return array
     */
    public function ShowPanier(): array
    {
        $session = $this->requestStack->getSession();
    
         // Retourne le panier depuis la session, ou un tableau vide si aucun panier n'existe
        return $session->get('panier', []);
    }

     /**
     * Récupère les données complètes du panier, en associant chaque Produit avec sa quantité
     *
     * @return array
     */

      // Parcourt chaque élément du panier et récupère les détails du Produit depuis la base de données
    public function ShowDataPanier(): array{
        $panier = $this->ShowPanier(); // Récupère le panier actuel

        $dataPanier = [];

        foreach($panier as $id => $quantite){
            $Produit = $this->ProduitRepo->find($id);  // Cherche le Produit par son ID
            $dataPanier[] = [
                "Produit" => $Produit ,   // Ajoute l'objet Produit dans le tableau
                "quantite" => $quantite  // Ajoute la quantité associée au Produit
            ];

        }
        return $dataPanier;  // Retourne le panier avec les objets Produit et quantités
    }

    /**
     * Calcule le total du panier en fonction des prix des Produits et des quantités
     *
     * @return int
     */
    public function getTotal(): int {

            $panier = $this->ShowPanier();  // Récupère le panier actuel
            $total = 0;
    
            // Parcourt chaque élément du panier et calcule le total en multipliant prix et quantité
            foreach($panier as $id => $quantite){
                $Produit = $this->ProduitRepo->find($id); // Cherche le Produit par son ID
                $total += $Produit->getPrixAchatProduit() * $quantite; // Additionne le total
            }

            return $total;  // Retourne le total du panier
    }

    public function getQuantite(): int {

        $panier = $this->ShowPanier();  // Récupère le panier actuel
        $nombrearticle = 0;

        // Parcourt chaque élément du panier et calcule le nombre total d'article
        foreach($panier as $id => $quantite){
            $nombrearticle += $quantite; // Additionne la quantité 
        }

        return $nombrearticle;  // Retourne le total du panier
}
    
        /**
     * Ajoute un Produit dans le panier ou incrémente la quantité s'il existe déjà
     *
     * @param Produit $Produit
     */
    public function AddOneDish(Produit $Produit): Void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);// Récupère le panier ou un tableau vide
        $id = $Produit->getId();// Récupère l'ID du Produit
    
        // Si le Produit est déjà dans le panier, on incrémente la quantité, sinon on l'ajoute
        if (!empty($panier[$id])){
            $panier[$id]++;
        } else{
            $panier[$id] = 1;
        }
    
        // Sauvegarde le panier mis à jour dans la session
        $session->set('panier', $panier);
    
    }
   

    /**
     * Réduit la quantité d'un Produit dans le panier ou le supprime si la quantité atteint 0
     *
     * @param Produit $Produit
     */
    public function RemoveOneQuantity(Produit $Produit): void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []); // Récupère le panier
        $id = $Produit->getId(); // Récupère l'ID du Produit

        // Si le Produit est dans le panier et que la quantité est supérieure à 1, on la réduit
        if (!empty($panier[$id])){
            if ($panier[$id] > 1){
            $panier[$id]--;
        } else {
            unset($panier[$id]); // Si la quantité est 1, on supprime le Produit du panier
        }}

        // Sauvegarde le panier mis à jour dans la session
        $session->set('panier', $panier);

    }

        /**
     * Supprime complètement un Produit du panier
     *
     * @param Produit $Produit
     */
    public function DeleteOneDish(Produit $Produit): void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []); // Récupère le panier
        $id = $Produit->getId();// Récupère l'ID du Produit

        // Si le Produit est dans le panier, on le supprime
        if (!empty($panier[$id])){
            unset($panier[$id]);}

        // Sauvegarde le panier mis à jour dans la session
        $session->set('panier', $panier);

    }

    /**
     * Vide complètement le panier
     */
    public function DeleteAllDish(): void
    {
        $session = $this->requestStack->getSession();
        // Supprime tous les Produits du panier en le réinitialisant à un tableau vide
        $session->set('panier', []);
        // $session->remove('panier'); Les deux commandes sont identiques. PS : ceux qui ont cette même ligne en commentaire, je vous vois ;)
    }
}