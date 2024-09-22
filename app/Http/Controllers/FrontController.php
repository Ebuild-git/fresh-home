<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\config;
use App\Models\Banners;
use App\Models\commandes;
use App\Models\contenu_commande;
use App\Models\gouvernorats;
use App\Models\produits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $banners = [];
        $bans = Banners::where('type', "banner")
            ->select('photo', 'titre', 'show_text')
            ->get();
        foreach ($bans as $ban) {
            $banners[] = [
                'photo' => Storage::url($ban->photo),
                'titre' => $this->addBreaksAfterWords($ban->titre),
                'titre_complet' => $ban->titre,
                "show_text" => $ban->show_text,
            ];
        }
        $categories = categories::all();
        $news = produits::Orderby('id', 'desc')->take(8)->get();
        $randoms = produits::inRandomOrder()
        ->select('nom','prix','photo','id_categorie','id_promotion')
        ->whereNotNull('id_promotion')
        ->limit(8)
        ->get();
        $topProduits = contenu_commande::select('id_produit', DB::raw('SUM(quantite) as total_quantite'))
            ->groupBy('id_produit')
            ->orderByDesc('total_quantite')
            ->limit(8)
            ->get();
        return view('front.index')
            ->with('banners', $banners)
            ->with('categories', $categories)
            ->with('news', $news)
            ->with('randoms', $randoms)
            ->with('topProduits', $topProduits);
    }

    function addBreaksAfterWords($text, $wordsPerLine = 7)
    {
        $words = explode(' ', $text);
        $lines = [];
        foreach (array_chunk($words, $wordsPerLine) as $chunk) {
            $lines[] = implode(' ', $chunk);
        }
        return implode('<br>', $lines);
    }

    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role = "admin") {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            $banner = Banners::where('type', "login")->first();
            return view('front.login')
                ->with('banner', $banner);
        }
    }



    public function forgotpassword()
    {
        return view('front.forgotpassword');
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
        $banner = Banners::where('type', "shop")->first();

        // recuperer le prix de l'article le plus couteux
        $max_price = produits::max('prix');
        $min_price = produits::min('prix');
        return view('front.shop')
            ->with('produits', $produits)
            ->with('categories', $categories)
            ->with('IDcategorie', $IDcategorie)
            ->with('key', $key)
            ->with('banner', $banner)
            ->with('max_price', $max_price)
            ->with('min_price', $min_price);
    }


    public function produit($id)
    {
        $produit = produits::find($id);
        if (!$produit) {
            $message = "Produit non disponible!";
            abort(404, $message);
        }
        $autres = produits::where('id_categorie', $produit->id_categorie)
        ->where('id', '!=', $produit->id)
        ->select('id','nom','prix','photo','id_categorie','id_promotion')
        ->take(20)
        ->get();
        $banner = Banners::where('type', "contact")->first();
        return view('front.produit')
            ->with('produit', $produit)
            ->with('autres', $autres)
            ->with('banner', $banner);
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
        $max_price = $request->input('max_price') ?? null;
        $min_price = $request->input('min_price') ?? null;
        $promotion = $request->input('promotion') ?? "false";

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
        if ($promotion == "true") {
            $produits->whereNotNull('id_promotion');
        }
        if ($id_categorie) {
            $produits->where('id_categorie', $id_categorie);
        }
        if ($max_price) {
            $produits->where('prix', '<', $max_price);
        }
        if ($min_price) {
            $produits->where('prix', '>', $min_price);
        }
        if ($key) {
            $produits->where('nom', 'like', '%' . $key . '%')
                ->orWhere('reference', 'like', '%' . $key . '%')
                ->orWhere('description', 'like', '%' . $key . '%');
        }
        $produits = $produits->select('nom', 'photo', 'id', 'prix')->paginate(25);

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
        $user = auth()->user();
        $banner = Banners::where('type', "profile")->first();
        $commandes = commandes::where('id_user', $user->id)
            ->Orderby("id", "Desc")
            ->get();
        return view('front.profile')
            ->with('user', $user)
            ->with('banner', $banner)
            ->with('commandes', $commandes);
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
                    "photo" => Storage::url($produit->photo),
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
        $banner = Banners::where('type', "checkout")->first();
        return view('front.checkout')
            ->with('panier', $panier)
            ->with('montant', $montant)
            ->with('montant_final', $montant_final)
            ->with('user', $user ?? null)
            ->with('frais_livraison', $frais)
            ->with('timbre', $timbre)
            ->with('config', $config)
            ->with('gouvernorats', $gouvernorats)
            ->with('add_frais', $add_frais)
            ->with('banner', $banner);
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
