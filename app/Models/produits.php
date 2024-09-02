<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class produits extends Model
{
    use HasFactory, SoftDeletes;


    public function vendus()
    {
        return $this->hasMany(contenu_commande::class, 'id_produit');
    }

    public function getPrice()
    {
        //recuperer le prix en fonction du pays selectioner
        $pays =  request()->cookie('countryName') ?? "TN";
        $prix = $this->prix;
        if ($this->id_promotion) {
            $promotion = promotions::find($this->id_promotion);
            if ($promotion) {
                $price = $prix - ($prix * ($promotion->pourcentage / 100));
                return $price;
            } else {
                return $prix;
            }
        } else {
            return $prix;
        }
    }


    public function getPrixVente()
    {
        $pays =  request()->cookie('countryName') ?? "TN";
        return $this->prix;
    }


    public function Get_price_sans_tva($valeur_tva, $prix_unitaire)
    {
        $prix_sans_tva = $prix_unitaire / (1 + ($valeur_tva / 100));
        return number_format($prix_sans_tva, 3, '.', '');
    }

    public function Get_valeur_tva($valeur_tva, $prix_unitaire)
    {
        $prix_sans_tva = $prix_unitaire / (1 + ($valeur_tva / 100));
        return number_format($prix_unitaire - $prix_sans_tva, 3, '.', '');
    }


    public function inPromotion()
    {
        if ($this->id_promotion) {
            $promotion = promotions::find($this->id_promotion);
            return $promotion ?: false;
        }

        return false;
    }

    public function diminuer_stock(int $quantite): void
    {
        if ($this->stock >= $quantite) {
            $this->stock -= $quantite;
            $this->save();
        }
    }

    public function retourner_stock(int $quantite): void
    {
        $this->stock += $quantite;
        $this->save();
    }


    public function historique_stock()
    {
        return $this->hasMany(historiques_stock::class, 'id_produit');
    }


    public function vues()
    {
        return $this->hasMany(views::class, 'id_produit');
    }

    public function categorie()
    {
        return $this->belongsTo(categories::class, 'id_categorie');
    }



    public function FirstImage()
    {
        if ($this->photo) {
            return Storage::url($this->photo);
        } else {
            return "/icons/product-658b4db7e7df5.png";
        }
    }


    public function getPrice_with_autre_prix($quantite)
    {
        if ($this->autres_prix) {
            $autres_prix = autres_prix::where('id_produit', $this->id)
                ->where('quantite', $quantite)
                ->first();
            if ($autres_prix) {
                return $autres_prix->prix;
            } else {
                return $this->prix;
            }
        } else {
            return $this->prix;
        }
    }



    public function autres_prix()
    {
        return $this->hasMany(autres_prix::class, 'id_produit');
    }
}
