<?php

namespace App\Http\Controllers;

use App\Mail\Commande;
use App\Models\commandes;
use App\Models\config;
use App\Models\contenu_commande;
use App\Models\notifications;
use App\Models\produits;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Throwable;

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
        $user = Auth::user();
        // on se rassur que l'user a tous mis comme coordonner
        if(!$user->nom || !$user->id_gouvernorat || !$user->adresse || !$user->phone){
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
        $commande->adresse = $user->adresse;
        $commande->id_gouvernorat = $user->id_gouvernorat;
        $commande->nom = $user->nom;
        $commande->note = $user->note;
        $commande->email = $user->email;
        $commande->phone = $user->phone;
        $commande->id_user = $user->id;
        $commande->by = $user->id;
        $commande->mode_paiement = "offline";
        if ($commande->save()) {
            $commande->update(['token' => $token]);

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
            $this->make_notification($commande);

            //supprimer le panier
            session()->forget('panier_front');
            return redirect()
                ->route('profile')
                ->with('success', 'Commande créée avec succès, veuillez patienter pendant le paiement sur Konnect');
        } else {
            return redirect()
                ->back()
                ->with("error", "Echec de la création de la commande");
        }
    }





    public function make_notification($commande)
    {
        $user = Auth::user();

        //generer la notification
        $notif = new notifications();
        $notif->type = "commande";
        $notif->titre =  $user->nom;
        $notif->url = "/admin/commande/" . $commande->id;
        $notif->message = "Nouvelle commande de " .  $this->user->nom;
        $notif->save();

        //envoyer le mail de confirmation
        try {
            Mail::to($commande->email)->send(new Commande($commande->id));
        } catch (Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }





    public function payment_success(Request $request, $token)
    {

        $commande = commandes::where('token', $token)->first();
        if (!$commande) {
            abort(404, "Commande introuvable");
            return;
        }

        //generaation de l descrition de la commande a envoyer a Jax

        //envouyer la commande jax
        $dataToSend = [
            "referenceExterne" => "",
            "nomContact" => $commande->nom . " " . $commande->prenom ?? "",
            "tel" => $commande->phone ?? "",
            "tel2" =>  "",
            "adresseLivraison" => $commande->adresse ?? "",
            "governorat" => $commande->id_gouvernorat,
            "delegation" => $commande->gouvernorat->nom,
            "description" => $commande->ProduitsText(),
            "cod" => $commande->montant(),
            "echange" => 0
        ];

        try {
            $response = $this->JaxApi->CreateColis($dataToSend);
            if ($response->successful()) {
                $jax = $response->json();
            } else {
                $jax = null;
            }
        } catch (\Exception $e) {
            $jax = null;
        }
        // Vérifiez que la réponse contient bien le code
        $sidCode = isset($jax['code']) ? $jax['code'] : null;

        if ($sidCode) {
            $commande->code_in_api = $sidCode;
        }


        $commande->paymentRef = $request->payment_ref;
        $commande->etat = 'confirmé';
        $commande->save();

        // Mettre à jour le stock des produits commandés
        foreach ($commande->contenus as $contenus) {
            $article = produits::find($contenus->produit->id_produit);
            if ($article) {
                $article->diminuer_stock($contenus->produit->quantite);
            }
        }


        session()->forget('panier_front');
        return redirect()->route('orders')->with('success', "Votre commande a été payé !");
    }


    public function payment_failure(Request $request)
    {
        abort(404, "echec du paiement");
    }
}
