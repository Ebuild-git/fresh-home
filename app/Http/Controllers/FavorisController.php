<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\favoris;
use App\Models\produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $favoris = favoris::where('id_user', $user->id)->get();
        $banner = Banners::where('type', "contact")->first();
        return view('front.favoris', compact('favoris','banner'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "Veuillez vous connecter !"
                ]
            );
        }
        $id_produit = $request->input('id_produit');
        $produit = produits::find($id_produit);
        if (!$produit) {
            return response()->json(
                [
                    "status" => false,
                    "message" => "Produit introuvable en stock !"
                ]
            );
        }

        $count = favoris::where('id_user', Auth::user()->id)->where("id_produit", $id_produit)->count();
        if ($count != 0) {
            return response()->json(
                [
                    "status" => true,
                    "message" => "Produit déja ajouté !"
                ]
            );
        }

        $favoris = new favoris();
        $favoris->id_user = Auth::user()->id;
        $favoris->id_produit = $id_produit;
        $favoris->save();
        return response()->json(
            [
                "status" => true,
                "message" => "Produit ajouté",
            ]
        );
    }


    public function get()
    {
        $favoris = favoris::where('id_user', Auth::user()->id)->get();
        $html = "";
        $html .= view('components.favoris-liste', compact('favoris'))->render();
        return response()->json([
            "statut" => true,
            "favoris" => $favoris,
            "total" => $favoris->count(),
            "html" => $html
        ]);
    }


    public function delete(Request $request)
    {
        //validation
        $this->validate($request, [
            'id_produit' => 'required|exists:produits,id'
        ]);

        $id_produit = $request->input("id_produit") ?? null;
        $favori = favoris::where('id_user', Auth::user()->id)
            ->where('id_produit', $id_produit)
            ->first();
        if ($favori) {
            $favori->delete();
            return response()->json(
                [
                "status" => true,
                "message" => "Produit supprimé de vos favoris"
            ]
        );
        } else {
            return response()->json(
                [
                "status" => false,
                "message" => "Le produit n'est pas dans vos favoris"
            ]
        );
        }
    }
}
