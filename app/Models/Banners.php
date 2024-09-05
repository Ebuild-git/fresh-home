<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;


    public function position()
    {
        if ($this->type == "banner") {
            return "Page d'acceuil";
        } elseif ($this->type == "shop") {
            return "Page shop";
        } elseif ($this->type == "contact") {
            return "Page de contact";
        } elseif ($this->type == "reset") {
            return "Page de réinitialisation du mot de passe";
        } elseif ($this->type == "profile") {
            return "Page de profile";
        } elseif ($this->type == "cart") {
            return "Page de panier";
        } elseif ($this->type == "login") {
            return "page de connexion";
        } elseif ($this->type == "favoris") {
            return "page de favoris";
        } elseif ($this->type == "checkout") {
            return "page de paiement";
        } elseif($this->type  == "produit")
        {
            return "Page inconnue";
        }
    }
}
