<?php

namespace App\Livewire\Front;

use App\Mail\register as MailRegister;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Register extends Component
{

    public $nom, $prenom, $email, $telephone, $password;

    public function render()
    {
        return view('livewire.front.register');
    }


    public function register()
    {
        $this->validate([
            'nom' => 'required|string',
            'prenom' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric',
            'password' => 'required|min:8',
        ], [
            'nom.required' => 'Veuillez entrer votre nom',
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
            'telephone.numeric' => 'Veuillez entrer un numéro de téléphone valide',
            'password.required' => 'Veuillez entrer votre mot de passe',
            'password.min' => 'Votre mot de passe doit contenir au moins 8 caractères',

        ]);

        $user = new User();
        $user->nom = $this->nom;
        $user->prenom = $this->prenom;
        $user->email = $this->email;
        $user->phone = $this->telephone;
        $user->password = Hash::make($this->password);
        $user->save();

        //send email
        try {
            //Mail::to($user->email)->send(new MailRegister($user));
        } catch (Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            //flah info message
            session()->flash('info', "Echec de l'envoie de l'email de confirmation, mais le compte a été créé avec succès.");
            return;
        }

        // connecter directement la personne
        auth()->login($user);

        return redirect()->route('home')->with('success', 'Votre compte a bien été créé! Vous pouvez maintenant vous connecter.');
    }
}
