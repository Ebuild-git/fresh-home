<?php

namespace App\Http\Controllers;

use App\Mail\Commande;
use App\Models\commandes;
use App\Models\config;
use App\Models\contenu_commande;
use App\Models\notifications;
use App\Models\produits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PayementController extends Controller
{

    protected $JaxApi;
    public $user;

    public function __construct(JaxApi $JaxApi, Request $request)
    {
        $this->JaxApi = $JaxApi;
        $this->user = Auth::check() ? Auth::user() : $this->createGuestUser($request);
    }


    private function createGuestUser($request)
    {
        return (object) [
            'nom' => $request->nom,
            'email' => $request->email,
            'phone' => $request->telephone,
            'adresse' => $request->adresse,
            'code_postal' => $request->code_postal,
        ];
    }



    public function commander(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user = [
                "id" => $user->id,
                'nom' => $user->nom,
                'id_gouvernorat' => $user->id_gouvernorat,
                'adresse' => $user->adresse,
                'phone' => $user->phone,
                'email' => $user->email,
            ];
        } else {
            $this->validate($request, [
                'nom' => 'required|string|max:100',
                'adresse' => 'required|string|max:150',
                'phone' => 'required|string|max:100',
                'id_gouvernorat' => 'required|integer',
                'email' => 'required|email'
            ], [
                'nom.required' => "Veuillez saisir votre nom",
                'adresse.required' => "Veuillez saisir votre adresse",
                'phone.required' => "Veuillez saisir votre numéro de téléphone",
                'id_gouvernorat.required' => "Veuillez sélectionner votre gouvernorat",
                'email.required' => "Veuillez saisir votre email",
                'email.email' => "Veuillez saisir un email valide"
            ]);

            $user = [
                "id" => null,
                'nom' => $request->nom,
                'email' => $request->email,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'id_gouvernorat' => $request->id_gouvernorat,
            ];
        }

        // on se rassur que l'user a tous mis comme coordonner
        if (!$user['nom'] || !$user['id_gouvernorat'] || !$user['adresse'] || !$user['phone']) {
            return redirect()
                ->back()
                ->with('error', "Erreur de création de votre commande car vous n'avez pas fourni tous les coordonnées nécessaires!");
        }

        $config = config::first();
        $add_frais = true;
        $token = strtolower(str()->random(45));
        $pays =  request()->cookie('countryName') ?? "TN";
        $panier_temporaire = session('panier_front') ?? [];
        if (count($panier_temporaire) <= 0) {
            // Si le panier est vide, on redirige vers la page de checkout
            return redirect()
                ->route('error-page')
                ->with('error', "Erreur de création de votre commande car le panier est vide !");
        }

        //Enregistrer la commande
        $commande = new commandes();
        $commande->adresse = $user['adresse'];
        $commande->id_gouvernorat = $user['id_gouvernorat'];
        $commande->nom = $user['nom'];
        $commande->email = $user['email'];
        $commande->phone = $user['phone'];
        $commande->id_user = $user['id'];
        $commande->by = $user['id'];
        $commande->mode_paiement = "offline";
        $commande->token = $token;
        if ($commande->save()) {

            foreach ($panier_temporaire as $key => $item) {
                $produit = produits::find($item['id_produit']);
                if ($produit) {
                    if ($produit->frais_inclu == 1) {
                        $add_frais = false;
                    }
                    $contenu_commande = new contenu_commande();
                    $contenu_commande->id_commande = $commande->id;
                    $contenu_commande->id_produit = $produit->id;
                    $contenu_commande->quantite = $item['quantite'];
                    $contenu_commande->prix_unitaire = $produit->getPrice();
                    $contenu_commande->benefice = ($produit->getPrice() - $produit->getPrixVente()) * $item['quantite'];
                    $contenu_commande->prix_total = $produit->getPrice()  * $item['quantite'];
                    $contenu_commande->save();
                }
            }

            if ($commande->montant() <= 0) {
                $commande->delete();
                return redirect()
                    ->back()
                    ->with("error", "Echec de la création de la commande [ Erreur 13 ]");
            }

            if ($add_frais) {
                $commande->update(
                    [
                        'frais' => $config->getFrais()
                    ]
                );
            }

            if ($pays == "TN") {
                $commande->update(
                    [
                        'devise' => "DT"
                    ]
                );
            }
            $this->make_notification($commande, $user);

            //supprimer le panier
            session()->forget('panier_front');

            if (Auth::check()) {
                return redirect()
                    ->route('profile')
                    ->with('success', 'Commande créée avec succès');
            } else {
                return redirect()
                    ->route('login')
                    ->with('success-commande', 'Commande créée avec succès');
            }
        } else {
            return redirect()
                ->back()
                ->with("error", "Echec de la création de la commande");
        }
    }





    public function make_notification($commande, $user)
    {
        //generer la notification
        $notif = new notifications();
        $notif->type = "commande";
        $notif->titre =  $user['nom'];
        $notif->url = "/admin/commande/" . $commande->id;
        $notif->message = "Nouvelle commande de " .  $user['nom'];
        $notif->save();

        //envoyer le mail de confirmation
        try {
            Mail::to($commande->email)->send(new Commande($commande->id));
        } catch (Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }
}
