<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\commandes;
use App\Models\config;
use App\Models\contenu_commande;
use App\Models\favoris;
use App\Mail\Commande as MailCommande;
use App\Models\Banners;
use App\Models\gouvernorats;
use App\Models\notifications;
use App\Models\produits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banners::all();
        return view('front.index')
            ->with('banners', $banners);
    }

    public function login()
    {
        return view('front.login');
    }



    public function forgotpassword()
    {
        return view('front.forgotpassword');
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function shop(Request $request)
    {
        $key = $request->get('key') ?? null;
        $IDcategorie = $request->get('IDcategorie') ?? null;
        $Ordre = $request->get('Ordre') ?? null;
        $Ordre_prix = $request->get('Ordre_prix') ?? null;
        $produits = produits::query();
        if ($key) {
            $produits->where('nom', 'like', '%' . $key . '%')
                ->orWhere('reference', 'like', '%' . $key . '%')
                ->orWhere('description', 'like', '%' . $key . '%')
                ->orWhere('prix', 'like', '%' . $key . '%');
        }
        if ($IDcategorie) {
            $produits->where('id_categorie', $IDcategorie);
        }
        if ($Ordre) {
            if ($Ordre == 'Desc') {
                $produits->orderBy('id', "Desc");
            } else {
                $produits->orderBy('id', "Asc");
            }
        }
        if ($Ordre_prix) {
            if ($Ordre_prix == 'Desc') {
                $produits->orderBy('prix', "Desc");
            } else {
                $produits->orderBy('prix', "Asc");
            }
        }
        $produits = $produits->paginate(25);
        $categories = categories::all();
        return view('front.shop')
            ->with('produits', $produits)
            ->with('categories', $categories)
            ->with('IDcategorie', $IDcategorie)
            ->with('key', $key);
    }


    public function orders()
    {
        $commande = commandes::where('id_user', Auth::id())->orderby('id', "Desc")->get();
        return view('front.orders')
            ->with('commandes', $commande);
    }

    public function produit($id)
    {
        $produit = produits::find($id);
        if (!$produit) {
            $message = "Produit non disponible!";
            abort(404, $message);
        }
        $autres = produits::where('id_categorie', $produit->id_categorie)->take(10)->get();
        return view('front.produit')
            ->with('produit', $produit)
            ->with('autres', $autres);
    }

    public function about()
    {
        return view('front.about');
    }


    public function shop_live(Request $request)
    {
        $id_categorie = $request->input('id_categorie') ?? null;
        $key = $request->input('key') ?? null;
        $ordre = $request->input('ordre') ?? null;

        $produits = produits::query();
        if ($ordre) {
            if ($ordre == "price") {
                $produits->orderBy('prix', 'asc');
            }
            if ($ordre == "price-desc") {
                $produits->orderBy('prix', 'desc');
            }
            if ($ordre == "popularity") {
                $produits->orderBy('created_at', 'desc');
            }
        }
        if ($id_categorie) {
            $produits->where('id_categorie', $id_categorie);
        }
        if ($key) {
            $produits->where('nom', 'like', '%' . $key . '%')
                ->orWhere('reference', 'like', '%' . $key . '%')
                ->orWhere('description', 'like', '%' . $key . '%');
        }
        $produits = $produits->paginate(25);

        $html = "";
        $html .= view('components.shop-liste', compact('produits'))->render();
        return response()->json(
            [
                'html' => $html,
                'success' => true,
            ]
        );
    }




    public function profile()
    {
        return view('front.profile');
    }

    public function checkout()
    {
        if (Auth::check()) {
            $user = Auth::user();
        }

        $config = config::first();
        if (!session()->has('panier_front')) {
            session(['panier_front' => []]);
        }
        // Récupérer le panier de la session
        $panier_temporaire = session('panier_front');

        if (!$panier_temporaire) {
            return redirect()->route('cart');
        }

        $panier = [];
        $montant = 0;
        $frais = 0;
        $add_frais = true;
        $montant_final = 0;
        foreach ($panier_temporaire as $key => $item) {
            $produit = produits::find($item['id_produit']);
            if ($produit) {
                if ($produit->frais_inclu == 1) {
                    $add_frais = false;
                }
                $panier[] = [
                    "photo" => $produit->FirstImage(),
                    "nom" => $produit->nom,
                    "quantite" => $item['quantite'],
                    "prix" => $produit->getPrice(),
                    "id" => $key,
                    "id_produit" => $produit->id,
                    "total" => $produit->getPrice() * $item['quantite']
                ];
                $montant += $produit->getPrice() * $item['quantite'];
            }
        }

        if ($add_frais) {
            $frais =  $config->frais ?? 0;
        }
        if ($montant == 0) {
            return redirect()->route('cart');
        }
        $timbre = $config->timbre;
        $montant_final = $montant + $frais;
        $gouvernorats = gouvernorats::all();
        return view('front.checkout')
            ->with('panier', $panier)
            ->with('montant', $montant)
            ->with('montant_final', $montant_final)
            ->with('user', $user ?? null)
            ->with('frais_livraison', $frais)
            ->with('timbre', $timbre)
            ->with('config', $config)
            ->with('gouvernorats', $gouvernorats)
            ->with('add_frais', $add_frais);
    }



    public function change_password()
    {
        return view('front.change_password');
    }


    public function password_reset(Request $request)
    {
        $token  = $request->get('token') ?? null;
        $user = User::where('token', $token)->first();
        if (!$user) {
            abort(404, "Token introuvable !");
        }
        return view('front.password_reset')
            ->with('token', $token);
    }


    public function error_page()
    {
        return view('front.error-page');
    }
}
