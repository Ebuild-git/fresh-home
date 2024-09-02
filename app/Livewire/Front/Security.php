<?php

namespace App\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Security extends Component
{
    public $current_pwd, $password, $password_confirmation;


    public function render()
    {
        return view('livewire.front.security');
    }

    public function update()
    {
        $this->validate([
            'current_pwd' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($this->password);
        $user->save();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Votre mot de passe a bien été mis à jour');
    }
}
