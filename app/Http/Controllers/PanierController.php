<?php

namespace App\Http\Controllers;

use App\Models\produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    public function add(Request $request)
    {
       

        $id_produit = $request->input('id_produit');
        $type = $request->input('type', 'produit');
        $quantite = $request->input('quantite', 1);

        $user = Auth::user();


        $produit = produits::find($id_produit);


        //verifier que le produit existe et est disponible
        if (!$produit) {
            return response()->json([
                'statut' => false,
                'message' => "Produit introuvable !",
            ]);
        }

        if($produit->stock < $quantite){
            return response()->json([
                'statut' => false,
                'message' => "Stock indisponible !",
            ]);
        }

       


        $panier = session('panier_front', []);
        $produit_existe = false;

        foreach ($panier as &$item) {
            if ($item['id_produit'] == $id_produit) {
                $item['quantite'] += $quantite;
                $produit_existe = true;
                break;
            }
        }

        if (!$produit_existe) {
            $panier[] = [
                'id_produit' => $id_produit,
                'quantite' => $quantite,
                'type' => $type,
            ];
        }

        session(['panier_front' => $panier]);

        return response()->json([
            'statut' => true,
            'message' => "Produit ajouté"
        ]);
    }


    public function count_panier()
    {
        // Vérifier si la session 'panier_front' existe, sinon initialiser une session vide
        if (!session()->has('panier_front')) {
            session(['panier_front' => []]);
        }
        // Récupérer le panier de la session
        $panier_temporaire = session('panier_front');
        $total = count($panier_temporaire);
        return response()->json(
            [
                "total" => $total,
            ]
        );
    }
    
}
