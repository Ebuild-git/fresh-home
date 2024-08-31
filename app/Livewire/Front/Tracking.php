<?php

namespace App\Livewire\Front;

use App\Models\commandes;
use Livewire\Component;

class Tracking extends Component
{

    public $id_commande,$commande;
    public function render()
    {
        return view('livewire.front.tracking');
    }

    public function track(){
        $this->validate([
            'id_commande' =>'required|exists:commandes,id|integer'
        ],[
            'id_commande.required' => 'Veuillez entrer votre ID de commande',
            'id_commande.exists' => 'Cette commande n\'existe pas',
            'id_commande.integer' => 'Veuillez entrer un ID de commande valide'
        ]);
        //code tracking
        $this->commande = commandes::find($this->id_commande);
    }

}
