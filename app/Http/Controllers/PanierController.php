<?php

namespace App\Http\Controllers;

use App\Models\produits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PanierController extends Controller
{
    public function add(Request $request)
    {


        $id_produit = $request->input('id_produit');
        $quantite = $request->input('quantite', 1);

        $user = Auth::user();


        $produit = produits::find($id_produit);


        //verifier que le produit existe et est disponible
        if (!$produit) {
            return response()->json([
                'status' => false,
                'message' => "Produit introuvable !",
            ]);
        }

        if ($produit->stock < $quantite) {
            return response()->json([
                'status' => false,
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
            ];
        }

        session(['panier_front' => $panier]);

        return response()->json([
            'status' => true,
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

        $produits = [];
        $montant = 0;
        foreach ($panier_temporaire ?? [] as $panier) {
            $produit = produits::find($panier['id_produit']);
            if ($produit) {
                $produits[] = [
                    "nom" => $produit->nom,
                    "quantite" => $panier['quantite'],
                    "prix" => $produit->getPrice(),
                    "photo" => Storage::url($produit->photo),
                    "slug" => Str::slug($produit->nom),
                    "id" => $produit->id,
                ];
                $montant += $produit->getPrice() * $panier['quantite'];
            }
        }
        $html = "";
        $html .= view('components.panier-liste', compact('produits'))->render();
        return response()->json(
            [
                "total" => count($produits),
                "html" => $html,
                "montant" => $montant,
            ]
        );
    }


    public function delete(Request $request)
    {
        $id_produit = $request->input('id_produit');

        $panier = session('panier_front', []);

        foreach ($panier as $key => $item) {
            if ($item['id_produit'] == $id_produit) {
                unset($panier[$key]);
                break;
            }
        }

        session(['panier_front' => array_values($panier)]);

        return response()->json([
            'status' => true,
            'message' => "Produit supprimé"
        ]);
    }


    public function cart()
    {
        if (!session()->has('panier_front')) {
            session(['panier_front' => []]);
        }
        // Récupérer le panier de la session
        $panier_temporaire = session('panier_front');

        $produits = [];
        $montant = 0;
        foreach ($panier_temporaire ?? [] as $panier) {
            $produit = produits::find($panier['id_produit']);
            if ($produit) {
                $produits[] = [
                    "nom" => $produit->nom,
                    "quantite" => $panier['quantite'],
                    "prix" => $produit->getPrice(),
                    "photo" => Storage::url($produit->photo),
                    "slug" => Str::slug($produit->nom),
                    "id" => $produit->id,
                ];
                $montant += $produit->getPrice() * $panier['quantite'];
            }
        }
        return view('front.cart')
            ->with('produits', $produits);
    }
}
