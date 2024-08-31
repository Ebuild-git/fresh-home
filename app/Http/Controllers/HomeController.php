<?php

namespace App\Http\Controllers;

//require './vendor/autoload.php';


use App\Models\commandes;
use App\Models\config;
use App\Models\produits;
use App\Models\templates;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class HomeController extends Controller
{

    public function Not_Autorized()
    {
        $template = templates::where('meta_error', true)->first();
        $meta = $template->meta ?? "";
        return view("front.Not_Autorized", compact("meta"));
    }


    public function set_cookie($pays)
    {
        $minutes = 600000;
        $cookie = Cookie::make('countryName', $pays, 30, null, null, false, false);
        Cookie::queue($cookie);
        return redirect()->back()->with('success', 'Pays sélectionné !');
    }
    


    public function view_produit($id)
    {
        $produit = produits::find($id);
        if (!$produit) {
            abort('404');
        }
        $Html = view('components.modal-view-produit', ['produit' => $produit, 'show' => true])->render();
        return response()->json($Html);
    }



    public function print_commande($id)
    {
        $commande = commandes::find($id);
        if (!$commande) {
            abort('404');
        }
        $config = config::first();

        $pdf = PDF::loadView('pdf.commande', compact('commande', 'config'));
        return $pdf->download("Facture-#" . $commande->id . ".pdf");
    }
    public function print_commande2($token)
    {
        $commande = commandes::where('token', $token)->first();
        if (!$commande) {
            abort('404');
        }
        $config = config::first();
        $pdf = PDF::loadView('pdf.commande', compact('commande', 'config'));
        return $pdf->download("Facture-#" . $commande->id . ".pdf");
    }



    public function print_bordereau(Request $request)
    {
        $ids = json_decode($request->get('ids'));
        $pdf = PDF::loadView('pdf.bordereau', compact("ids"));
        return $pdf->download("bordereau.pdf");
    }



    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }


    public function inscription()
    {
        return view('front.inscription');
    }
    
}
