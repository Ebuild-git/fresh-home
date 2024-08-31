<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commandes extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'paymentRef',
        'statut',
        'frais'
    ];


    public function contenus()
    {
        return $this->hasMany(contenu_commande::class, 'id_commande');
    }

    public function montant(){
        $total = $this->frais + $this->timbre;
        foreach ($this->contenus as $contenu){
            $total += $contenu->prix_unitaire * $contenu->quantite;
        }
        return $total ?? 0;
    }

    public function client(){
        return $this->belongsTo(clients::class, 'phone','phone');
    }

    public function modifiable(){
        if ($this->statut === 'retournée' || $this->statut === 'payée' || $this->statut === 'livrée') {
            return false;
        } else {
            return true;
        }
    }

    public function montant_ht(){
        return $this->montant() / + $this->tva /10;
    }

    public function montant_ttc(){
        return $this->montant();
    }



    public function ProduitsText(){
        $produits = $this->contenus()->get();
        $text = "";
        foreach ($produits as $produit){
            $text.= $produit->produit->nom. " x ". $produit->quantite. " | ";
        }
        return $text;
    }


    public function Auteur(){
        return $this->belongsTo(User::class , 'by');
    }

    public function gouvernorat(){
        return $this->belongsTo(gouvernorats::class, 'id_gouvernorat','id');
    }

}
