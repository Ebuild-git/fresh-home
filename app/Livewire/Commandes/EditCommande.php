<?php

namespace App\Livewire\Commandes;

use App\Http\Traits\ListGouvernorats as TraitsListGouvernorats;
use App\Models\config;
use App\Models\contenu_commande;
use App\Models\gouvernorats;
use Livewire\Component;

class EditCommande extends Component
{
    public $commande, $gouvernoratsTunisie, $nom, $prenom, $adresse, $id_gouvernorat, $phone, $frais,$timbre,$tva;
    public $remise = null;
    public $remise_appliquee = false;
    public $total_remise = 0;

    public function mount($commande)
    {
        $this->commande = $commande;
        $this->nom = $commande->nom;
        $this->prenom = $commande->prenom;
        $this->adresse = $commande->adresse;
        $this->id_gouvernorat = $commande->id_gouvernorat;
        $this->phone = $commande->phone;
        $this->timbre = $commande->timbre;
        $this->tva = $commande->tva;
        $this->frais = $commande->frais;
        $this->remise = $commande->reduction;
        $this->remise_appliquee = $commande->reduction ? true : false;
        $this->total_remise = $commande->total_reduction;
    }

    public function render()
    {
        $this->gouvernoratsTunisie = gouvernorats::all();
        $config = config::first();
        return view('livewire.commandes.edit-commande')
            ->with('config', $config);
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



    public function update_user_info()
    {
        $this->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'adresse' => 'required|string|max:150',
            'phone' => 'required|string|max:100',
            'id_gouvernorat' => 'required|integer',
            'frais' => 'nullable',
            'timbre' => 'nullable',
            'tva' => 'nullable',

        ]);
        $config = config::first();
        $this->commande->nom = $this->nom;
        $this->commande->prenom = $this->prenom;
        $this->commande->adresse = $this->adresse;
        $this->commande->phone = $this->phone;
        $this->commande->id_gouvernorat = $this->id_gouvernorat;
        $this->commande->frais = $this->frais ? $config->frais : null;
        $this->commande->reduction = $this->remise_appliquee ? $this->remise : null;
        if($this->frais){
            $this->commande->frais = $config->getFrais();
        }else{
            $this->commande->frais = 0;
        }
        if($this->tva){
            $this->commande->tva = $config->getTva();
        }else{
            $this->commande->tva = 0;
        }
        if($this->timbre){
            $this->commande->timbre = $config->getTimbre();
        }else{
            $this->commande->timbre = 0;
        }
        $this->commande->save();

        //flash success message en frnancais
        session()->flash('success', __('Les informations de la commandes ont été  modifiés !'));
    }


    public function change($id_contenu, $quantite, $type)
    {
        $contenu = contenu_commande::find(intval($id_contenu));
        if (!$contenu) {
            //flash error message
            session()->flash('warning', 'Contenu non trouvé');
            return;
        }

        if ($type == "up") {
            //verification du stock
            if ($contenu->produit->stock < intval($quantite)) {
                //flash error message
                session()->flash('error', 'Quantité demandée excède le stock disponible pour ce produit');
                return;
            }
            $contenu->quantite =  intval($quantite);
            $contenu->produit->diminuer_stock(intval($quantite));
            $contenu->save();
        } else {
            //ajout d'un contenu à la commande
            $contenu->quantite =  intval($quantite);
            $contenu->produit->retourner_stock(intval($quantite));
            $contenu->save();
        }
    }

    public function delete($id)
    {
        $contenu = contenu_commande::find(intval($id));
        if (!$contenu) {
            //flash error message
            session()->flash('warning', 'Contenu non trouvé');
            return;
        }
        $contenu->delete();
        //fash mesage
        session()->flash('success', 'Le contenu a été supprimé de votre commande');

        $total = $this->commande->contenus->count();
        if ($total == 0) {
            //supprimer la commande
            $this->commande->delete();
            //redirection vers la page des commandes
            return redirect()->route('commandes')->with('success', '');
        }
    }
}
