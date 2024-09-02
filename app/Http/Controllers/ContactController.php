<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\contacts;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $banner = Banners::where('type', "contact")->first();
        return view('front.contact')
            ->with('banner', $banner);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|numeric',
            'message' => 'required|string'
        ], [
            'nom.required' => 'Veuillez entrer votre nom',
            'email.required' => 'Veuillez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'telephone.required' => 'Veuillez entrer votre numéro de téléphone',
            'message.required' => 'Veuillez entrer votre message'

        ]);

        $contact = new contacts();
        $contact->nom = $request->nom;
        $contact->email = $request->email;
        $contact->telephone = $request->telephone;
        $contact->message = $request->message;
        if ($contact->save()) {
            return redirect()->back()
                ->with('message', 'Votre message a bien été envoyé!');
        } else {
            return redirect()->back()
                ->with('error', 'Votre message n\'a pas été envoyé!');
        }
    }
}
