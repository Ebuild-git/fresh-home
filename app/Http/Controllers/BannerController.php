<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Http\Request;

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
        //validation
        $request->validate([
            'titre' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:3048',
        ]);

        $banner = new Banners();
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
        if ($banner->delete()) {
            return back()->with('success', 'Banner supprimé avec succès');
        } else {
            return back()->with('error', 'Erreur lors de la suppression du banner');
        }
    }
}
