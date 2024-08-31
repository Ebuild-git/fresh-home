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
        //validation input
        $this->validate($request, [
            'adresse' => 'required|string',
            'id_gouvernorat' => 'required|integer|exists:gouvernorats,id',
            'code_postal' => 'nullable|string',
            'nom' => 'required|string',
            'note' => 'nullable|string',
            'email' => 'required|email',
            'telephone' => 'required',
            'transaction_type' => 'required|in:online,offline'
        ]);



        $token = $this->make_commande($request);
        //dans le cas ou la fonction returne un redirect
        if ($token instanceof \Illuminate\Http\RedirectResponse) {
            return $token;
        }
        if ($request->transaction_type == "online") {
            return $this->online($token);
        } else {
            session()->forget('panier_front');
            return redirect()->route('orders')->with('success', "Votre commande a été créé !");
        }
    }



    public function online($token)
    {

        $konnect_key = config("app.konnect_key");
        $konnect_wallet = config("app.konnect_wallet");
        $commande = commandes::where('token', $token)->first();
        try {
            $client = new Client();
            if ($commande->devise == "dinar") {
                $devise = "TND";
                $montant = intval($commande->montant()) * 1000;
            } else {
                $devise = "USD";
                $montant = intval($commande->montant()) * 100;
            }

            $response = $client->request('POST', "https://api.konnect.network/api/v2/payments/init-payment", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-api-key' => $konnect_key,
                ],
                'json' => [
                    "receiverWalletId" => $konnect_wallet,
                    "token" => $devise,
                    "amount" => $montant,
                    "type" => "immediate",
                    "acceptedPaymentMethods" => ["wallet", "bank_card", "e-DINAR"],
                    "lifespan" => 10,
                    "checkoutForm" => false,
                    "addPaymentFeesToAmount" => true,
                    "firstName" => $this->user->nom,
                    "phoneNumber" => $this->user->phone,
                    "email" => $this->user->email,
                    "orderId" => $commande->id,
                    "webhook" => config("app.url"),
                    "silentWebhook" => true,
                    "successUrl" =>  route("payment-success", ['token' => $token]),
                    "failUrl" =>  route("payment-failure"),
                    "theme" => "light",
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            // Extract necessary information from the response
            if (isset($responseData['payUrl']) && isset($responseData['paymentRef'])) {
                // Extract the payUrl and paymentRef
                $payUrl = $responseData['payUrl'];
                $paymentRef = $responseData['paymentRef'];
                Session::put('paymentRef', $paymentRef);
                return redirect()->away($payUrl);
            } else {
                return redirect()
                    ->route('error-page')
                    ->with('error', "Une erreur s'est produite avec le paiement en ligne [ code 2]");
            }
        } catch (RequestException $e) {
            Log::error('Error making payment request: ' . $e->getMessage());
            return redirect()
                ->route('error-page')
                ->with('error', "Une erreur s'est produite avec le paiement en ligne [ code 3]");
        } catch (Throwable $e) {
            Log::error("Error making payment request: " . $e);
            return redirect()
                ->route('error-page')
                ->with('error', "Une erreur s'est produite avec le paiement en ligne [ code 1]");
        }
    }






    public function make_commande($request)
    {

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
        $commande->adresse = $request->adresse;
        $commande->id_gouvernorat = $request->id_gouvernorat;
        $commande->nom = $request->nom;
        $commande->note = $request->note;
        $commande->email = $request->email;
        $commande->phone = $request->telephone;
        //null dans le cas ou on est avec un client passager
        $commande->id_user = $this->user->id ?? null;
        $commande->by = $this->user->id ?? null;
        $commande->mode_paiement = $request->transaction_type;
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
                    ->route('error-page')
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
                        'devise' => "dinar"
                    ]
                );
            } else {
                $commande->update(
                    [
                        'devise' => "eruro"
                    ]
                );
            }
            $this->make_notification($commande);

            //supprimer le panier
            session()->forget('panier_front');

            return  $token;
        } else {
            return redirect()
                ->route('error-page')
                ->with("error", "Echec de la création de la commande");
        }
    }


    public function montant_total()
    {
        $panier = session('panier_front');
        $montant = 0;
        $config = config::first();
        foreach ($panier as $item) {
            $produit = produits::find($item['id_produit']);
            if ($produit) {
                $montant += $produit->prix_vente * $item['quantite'];
            }
        }
        $tva = $config->tva ?? 0;
        $timbre = $config->timbre ?? 0;
        $frais = $config->frais ?? 0;
        $montant_total = $montant + ($montant * $tva / 100) + $timbre + $frais;
        return $montant_total;
    }


    public function make_notification($commande)
    {
        //generer la notification
        $notif = new notifications();
        $notif->type = "commande";
        $notif->titre =  $this->user->nom;
        $notif->url = "/admin/commande/" . $commande->id;
        $notif->message = "Nouvelle commande";
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
