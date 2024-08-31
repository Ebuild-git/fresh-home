<?php

namespace App\Livewire\Front\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdatePassword extends Component
{

    public  $current_password,$password,$password_confirmation;

    public function render()
    {
        return view('livewire.front.profile.update-password');
    }



    public function update(){
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        if(Hash::check($this->current_password, $user->password)){
            $user->password = Hash::make($this->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Votre mot de passe a bien été mis à jour');
        }else{
            session()->flash('error', 'Le mot de passe actuel est incorrect');
            return ;
        }
    }


}
