<?php

namespace App\Livewire\Front;

use App\Models\gouvernorats;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Informations extends Component
{
    public $user, $nom, $prenom, $email, $telephone, $adresse,$id_gouvernorat;
    public $logout = false;

    public function mount()
    {
        $this->user = auth()->user();
        $this->nom = $this->user->nom;
        $this->prenom = $this->user->prenom;
        $this->email = $this->user->email;
        $this->telephone = $this->user->phone;
        $this->adresse = $this->user->adresse;
        $this->id_gouvernorat = $this->user->id_gouvernorat;
    }

    public function render()
    {
        $gouvernorats = gouvernorats::all();
        return view('livewire.front.informations')
            ->with('gouvernorats', $gouvernorats);
    }

    public function update()
    {
        $this->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|numeric',
            'adresse' => 'required|string',
            'id_gouvernorat' => 'required|integer|exists:gouvernorats,id',
        ]);
        $user  = User::find($this->user->id);
        if ($user) {
            $user->nom = $this->nom;
            $user->prenom = $this->prenom;
            $user->email = $this->email;
            $user->phone = $this->telephone;
            $user->adresse = $this->adresse;
            $user->id_gouvernorat = $this->id_gouvernorat;
            if ($this->email != $user->email) {
                if (User::where('email', $user)->exiist()) {
                    session()->flash('error', 'Adresse e-mail déjà utilisée');
                    return;
                } else {
                    $logout = true;
                    $user->email = $this->email;
                }
            }
            $user->save();
            if ($this->logout) {
                Auth::logout();
                return redirect()->route('login')->with('success', 'Vos informations ont été mises à jour avec succès');
            } else {
                session()->flash('success', 'Vos informations ont été mises à jour avec succès');
            }
        }
    }
}
