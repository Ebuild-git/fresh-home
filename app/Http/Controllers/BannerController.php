<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banners::all();
        return view('admin.parametres.banner')
            ->with('banners', $banners);
    }


    public function store(Request $request)
    {
        $rules = [
            'titre' => 'nullable|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            'type' => 'required|string|in:banner,shop,contact,profile,reset,checkout,cart,login,produit,favoris'
        ];
        if ($request->type == 'banner') {
            $rules['titre'] = 'required|max:255';
        }
        $request->validate($rules);
        


        //si on a une autre image que de type banner alors on supprime avant de ajouter la nouvelle
        if ($request->type != 'banner') {
            $found  = Banners::where('type', $request->type )->first();
            if($found){
                Storage::disk('public')->delete($found->photo);
                $found->delete();
            }
        }

        $banner = new Banners();
        $banner->type = $request->type;
        $banner->titre = $request->titre;
        $banner->photo = $request->photo->store('banners', 'public');
        if ($banner->save()) {
            return back()->with('success', 'Banner ajouté avec succès');
        } else {
            return back()->with('error', 'Erreur lors de l\'ajout du banner');
        }
    }

    public function destroy(Request $request, $id)
    {
        $banner = Banners::find($id);
        if ($banner) {
            Storage::disk('public')->delete($banner->photo);
            $banner->delete();
            return back()->with('success', 'Banner supprimé avec succès');
        } else {
            return back()->with('error', 'Erreur lors de la suppression du banner');
        }
    }
}
