<?php

namespace App\Livewire\Front;

use App\Mail\forget as MailForget;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Forget extends Component
{
    public $email;
    public $end = false;

    public function render()
    {
        return view('livewire.front.forget');
    }

    public function forget(){
        $this->validate([
            'email' =>'required|email|exists:users,email'
        ],[
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'email.exists' => 'Cet email n\'existe pas !'
        ]);

        $user = User::where('email', $this->email)->where('role','client')->first();
        if(!$user){
            session()->flash('error', 'Cet email n\'est pas associé à un compte client');
            return;
        }
        
        $token = $user->createToken('Reset Password')->plainTextToken;

        $url = route('password.reset', ['token' => $token]);

        $user->update(['token'=>$token]);
        Mail::to($this->email)->send(new MailForget($user,$url));

        $this->end = true;
    }
}
