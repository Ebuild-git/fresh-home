<?php

namespace App\Livewire\Commandes;

use App\Models\clients;
use App\Models\commandes;
use App\Models\config;
use App\Models\contenu_commande;
use App\Models\gouvernorats;
use App\Models\produits;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Services\JaxService;

class AjouterCommande extends Component
{
    public $key, $nom, $prenom, $frais, $timbre, $tva, $adresse, $gouvernorat, $phone, $recherche,$canal_vente, $clients = [];
    public $gouvernoratsTunisie;
    public $pays = "Tunisie";
    protected $listeners = ['ProduitAdded' => '$refresh'];
    public $remise = null;
    public $remise_appliquee = false;
    public $total_remise = 0;

    public function updatedRecherche($recherche)
    {
        if (strlen($recherche) > 0) {
            $this->clients = clients::where('nom', 'like', '%' . $recherche . '%')
                ->orWhere('prenom', 'like', '%' . $recherche . '%')
                ->orWhere('phone', 'like', '%' . $recherche . '%')
                ->take(10)
                ->get();
        } else {
            $this->clients = [];
        }
    }

    public function import($client)
    {
        $this->nom = $client["nom"];
        $this->prenom = $client["prenom"];
        $this->adresse = $client["adresse"];
        $this->phone = $client["phone"];
        $this->gouvernorat = $client["gouvernorat"];
        $this->pays = $client["pays"];

        $this->recherche = "";
        $this->clients = [];

        //flash message
        session()->flash("message", "Client Importé avec succés");
    }






    public function render()
    {
        $paniers = session()->get('panier', []);
        $this->gouvernoratsTunisie = gouvernorats::all();
        $config = config::first();
        return view('livewire.commandes.ajouter-commande', compact('paniers','config'));
    }


    public function appliquerRemise(){
        $this->validate([
            'remise' => 'required|numeric|min:0|max:100',
        ],[
            'remise.required' => 'La remise est obligatoire',
            'remise.numeric' => 'La remise doit être un nombre',
            'remise.min' => 'La remise doit être supérieure à 0',
            'remise.max' => 'La remise doit être inférieure à 100',
        ]);
        $this->remise_appliquee = true;
    }

    public function annulerRemise(){
        $this->remise_appliquee = false;
        $this->remise = null;
    }



    public function delete_from_session($key)
    {

        $panier = session('panier');
        unset($panier[$key]);
        session(['panier' => $panier]);
    }

    public function order(JaxService $JaxApi)
    {
        //validation du formulaire
        $this->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'adresse' => 'required|string|max:150',
            'phone' => 'required|string|max:100',
            'pays' => 'required|string|max:100',
            'gouvernorat' => 'required|integer|exists:gouvernorats,id',
            'frais' => 'nullable',
            'timbre' => 'nullable',
            'tva' => 'nullable',
            'canal_vente' => 'nullable|string|max:255',
        ]);


        //creer un nouveau client si le numerod e tel nest pas encore utiliser
        $count = clients::Where("phone", $this->phone)->count();
        if ($count == 0) {
            $client = new clients();
            $client->nom = $this->nom;
            $client->prenom = $this->prenom;
            $client->adresse = $this->adresse;
            $client->phone = $this->phone;
            $client->pays = $this->pays;
            $client->gouvernorat = $this->gouvernorat;
            $client->save();
        }



        $panier = session()->get('panier', []);
        if ($panier) {
            $config = config::first();
            $commande = new commandes();
            $commande->nom = $this->nom;
            $commande->prenom = $this->prenom;
            $commande->adresse = $this->adresse;
            $commande->phone = $this->phone;
            $commande->by = Auth::id();
            $commande->id_user = Auth::id();
            $commande->pays = $this->pays;
            $commande->id_gouvernorat = $this->gouvernorat;
            $commande->canal_vente = $this->canal_vente;
            $commande->etat = "confirmé";
            $commande->reduction = $this->remise ? $this->remise : null;
            if($this->frais){
                $commande->frais = $config->getFrais();
            }
            if($this->tva){
                $commande->tva = $config->getTva();
            }
            if($this->timbre){
                $commande->timbre = $config->getTimbre();
            }
            if ($commande->save()) {
                foreach ($panier as $panier) {
                    //recuperation du type
                    $quantite = intval($panier["quantite"]);
                    //il s'agit d'un produit
                    $article = produits::find($panier["id"]);
                    if ($article) {

                        if ($article->autres_prix()) {
                            $total = $article->getPrice_with_autre_prix($quantite);
                            $prix_unitaire = $total / $quantite;
                        } else {
                            $total = $article->getPrice() * $quantite;
                            $prix_unitaire = $article->getPrice();
                        }


                        $contenu = new contenu_commande();
                        $contenu->id_commande = $commande->id;
                        $contenu->id_produit = $article->id;
                        $contenu->quantite = $quantite;
                        $contenu->prix_total = $total;
                        $contenu->prix_unitaire = $prix_unitaire;
                        $contenu->benefice = ($prix_unitaire - $article->prix_achat) * $quantite;
                        $contenu->save();

                        //diminuer le stock
                        $article->diminuer_stock($quantite);
                    }
                }

                //delete session panier
                session()->forget('panier');
                try {
                    $response = $response = $JaxApi->CreateColis($commande->id);;
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
                    $commande->save();
                }
                //redirection
                return Redirect()->route('details_commande', ["id" => $commande->id])->with("success", "Votre commande a été enregistré");
            } else {
                //flash error message
                session()->flash('warning', 'Echec de la création de la commande.');
            }
        } else {
            //flash error message
            session()->flash('warning', 'Votre panier est vide.');
        }
    }
}
