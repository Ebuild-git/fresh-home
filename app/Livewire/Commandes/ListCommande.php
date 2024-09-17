<?php

namespace App\Livewire\Commandes;

use App\Models\commandes;
use App\Models\gouvernorats;
use App\Models\produits;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\JaxService;

class ListCommande extends Component
{
    use WithPagination;

    public $selectedCommandes = [];
    public $date, $statut, $key, $gouvernoratsTunisie, $gouvernorat, $statut2;



    public function updatedKey($value)
    {
        $this->key = $value;
        $this->resetPage();
    }


    public function render()
    {
        $commandesQuery = commandes::query();
        if (strlen($this->date) > 0) {
            $commandesQuery->whereDate('created_at', $this->date);
        }
        if (strlen($this->gouvernorat) > 0) {
            $commandesQuery->where('id_gouvernorat', $this->gouvernorat);
        }
        if (strlen($this->statut) > 0) {
            if ($this->statut == "retournée") {
                $commandesQuery->where('statut', $this->statut)
                    ->where('etat', "confirmé");
            } else {
                $commandesQuery->where('statut', $this->statut);
            }
        }
        if (strlen($this->statut2) > 0) {
            if ($this->statut2 == "confirmer") {
                $commandesQuery->where('etat', "confirmé");
            } else {
                $commandesQuery->where('etat', "annulé");
            }
        }
        if (strlen($this->key) > 0) {
            $commandesQuery->where('nom', 'like', '%' . $this->key . '%')
                ->orWhere('adresse', 'like', '%' . $this->key . '%')
                ->orWhere('phone', 'like', '%' . $this->key . '%')
                ->orWhere('prenom', 'like', '%' . $this->key . '%');
        }
        $commandes = $commandesQuery->Orderby('id', "Desc")->paginate(80);
        $total = commandes::count();
        $this->gouvernoratsTunisie = gouvernorats::all();
        return view('livewire.commandes.list-commande', compact("commandes", "total"));
    }


    public function updateStatus($commandeId, $newStatus)
    {
        // Mettre à jour le statut de la commande dans la base de données
        $commande = commandes::findOrFail($commandeId);
        if ($commande) {
            $commande->statut = $newStatus;

            //retourner le stock si l'etat de dla command epasser a retourner
            if ($newStatus == "retournée") {
                foreach ($commande->contenus as $contenus) {
                    $article = produits::find($contenus->id_produit);
                    if ($article) {
                        $article->retourner_stock($contenus->quantite);
                    }
                }
            }

            //enregistrer le chagement de l'etat de la commande
            $commande->save();
        }
    }



    public function delete($id)
    {
        $commande = commandes::find($id);
        if ($commande) {
            $commande->delete();

            //flash message
            session()->flash('success', 'Commande supprimée avec succès');
        }
        return view('livewire.commandes.list-commande');
    }

    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }


    public function confirmer(JaxService $JaxApi,$id)
    {
        $commande = commandes::find($id);
        //on retire maintenant le stock
        foreach ($commande->contenus as $contenus) {
            $article = produits::find($contenus->produit->id_produit);
            if ($article) {
                $article->diminuer_stock($contenus->produit->quantite);
            }
        }

        try {
            $response = $JaxApi->CreateColis($commande->id);
            if ($response->successful()) {
                $jax = $response->json();
            } else {
                $jax = null;
            }
        } catch (\Exception $e) {
            $jax = null;
        }
        // Vérifiez que la rép;onse contient bien le code
        $sidCode = isset($jax['code']) ? $jax['code'] : null;

        if ($sidCode) {
            $commande->code_in_api = $sidCode;
        }

        if ($commande) {
            $commande->etat = "confirmé";
            $commande->save();
        }
    }









    public function annuler($id)
    {
        $commande = commandes::find($id);
        if ($commande) {
            $commande->statut = "retournée";
            $commande->etat = "annulé";
            $commande->save();
        }
    }


    public function toggleCommandeSelection($commandeId)
    {
        if (in_array($commandeId, $this->selectedCommandes)) {
            $this->selectedCommandes = array_diff($this->selectedCommandes, [$commandeId]);
        } else {
            $this->selectedCommandes[] = $commandeId;
        }
    }


    public function getSelectedCommandes()
    {
        //check if $this->selectedCommandes is not empty
        if (count($this->selectedCommandes) > 0) {
            $ids = json_encode($this->selectedCommandes);
            return redirect()->route('print_bordereau', ["ids" => $ids]);
        } else {
            return false;
        }
    }
}
