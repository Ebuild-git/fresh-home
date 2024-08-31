<?php

namespace App\Livewire;

use App\Models\clients;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListClients extends Component
{
    use WithPagination;

    public $key;
    public $deleted_confirmed = false;

    public function delete_client()
    {
        $this->deleted_confirmed = true;
    }

    public function render()
    {
        $clients = User::Orderby("created_at")->where('role', "client");
        if (isset($this->key)) {
            $clients->where('nom', 'like', '%' . $this->key . '%')
                ->orWhere('phone', 'like', '%' . $this->key . '%')
                ->orWhere('prenom', 'like', '%' . $this->key . '%');
        }
        $clients = $clients->paginate(30);
        $total = User::where('role', "client")->count();
        return view('livewire.list-clients', compact('clients', 'total'));
    }


    public function delete_all_client()
    {
        $clients = User::Orderby("created_at")->where('role', "client")->get();
        foreach ($clients as $client) {
            $client->update(
                [
                    'email' => $client->email . '-deleted-' . time(),
                ]
            );
            $client->delete();
        }
        //flash message
        session()->flash('success', 'Tous les clients ont été supprimés avec succès!');
        $this->deleted_confirmed = false;
        $this->resetPage();
    }

    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }

    public function delete($id)
    {
        //delete client
        $client = User::find($id);
        if ($client) {
            $client->update(
                [
                    'email' => $client->email . '-deleted-' . time(),
                ]
            );
            $client->delete();
            //flash message
            session()->flash('success', 'Client supprimé avec succès!');
        }
    }
}
