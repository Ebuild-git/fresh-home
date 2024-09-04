<?php

namespace App\Livewire\Produits;

use App\Models\autres_prix;
use App\Models\categories;
use App\Models\produits;
use App\Models\sous_categories;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduit extends Component
{
    use WithFileUploads;

    public $nom, $prix, $photo, $photos, $prix_achat, $photo2, $photos2, $produit, $reference, $description, $id_categorie;
    public $new_prix, $new_qte;
    public $frais_inclu = false;

    public function mount($produit)
    {
        if ($produit) {
            $this->produit = $produit;
            $this->nom = $produit->nom;
            $this->reference = $produit->reference;
            $this->prix = $produit->prix;
            $this->prix_achat = $produit->prix_achat;
            $this->photo2 = $produit->FirstImage();
            $this->photos2 = $produit->photos;
            $this->description = $produit->description;
            $this->id_categorie = $produit->id_categorie;
            $this->frais_inclu = $produit->frais_inclu;
        }
    }





    public function render()
    {
        $categories = categories::all();
        return view('livewire.produits.add-produit')
            ->with('categories', $categories);
    }






    //validation
    public function create()
    {
        $this->validate([
            'nom' => 'required|string',
            'reference' => 'required|string|unique:produits,reference',
            'prix' => 'required|numeric|gt:prix_achat',
            'prix_achat' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description' => 'nullable|string',
            'id_categorie' => 'required|exists:categories,id',
            'frais_inclu' => 'nullable|boolean',
        ], [
            'required' => "Ce champ est obligatoire"
        ]);



        $produit = new produits();
        $produit->nom = $this->nom;
        $produit->reference = $this->reference;
        $produit->prix = $this->prix;
        $produit->prix_achat = $this->prix_achat;
        $produit->description = $this->description;
        $produit->id_categorie = $this->id_categorie;
        $produit->frais_inclu = $this->frais_inclu ? true : false;
        $produit->photo = $this->photo->store('produits', 'public');
        if ($this->photos) {
            $photosPaths = [];
            foreach ($this->photos as $photo) {
                $photosPaths[] = $photo->store('produits', 'public');
            }
            $produit->photos = json_encode($photosPaths);
        }
        $produit->save();

        //reset input
        $this->reset(
            [
                'nom',
                'reference',
                'prix',
                'photo',
                'photos',
                'prix_achat',
                'description',
                'id_categorie',
                'frais_inclu',
            ]
        );

        //flash message
        session()->flash('success', 'Produit ajouté avec succès');
    }








    public function removePrix($id)
    {
        autres_prix::where("id", $id)->where('id_produit', $this->produit->id)->delete();

        //flash message
        session()->flash('add-success', 'Prix supprimé avec succès');
    }






    function AddPrix()
    {
        $this->validate([
            'new_qte' => 'required|numeric|min:2',
            'new_prix' => 'required|numeric',
        ], [
            'new_qte.required' => 'La quantité est obligatoire',
            'new_qte.numeric' => 'La quantité doit être un nombre',
            'new_qte.min' => 'La quantité doit être supérieure ou égale à 2',

            'new_prix.required' => 'Le prix est obligatoire',
            'new_prix.numeric' => 'Le prix doit être un nombre',
        ]);


        // on verifie que il existe pas encore cette quantite pour ce produit
        $count = autres_prix::where('quantite', $this->new_qte)
            ->where('id_produit', $this->produit->id)
            ->count();


        if ($count > 0) {
            session()->flash('add-error', 'Cette quantité existe déjà pour ce produit.');
            return;
        }

        //add
        $autre_prix = new autres_prix();
        $autre_prix->quantite = $this->new_qte;
        $autre_prix->prix = $this->new_prix;
        $autre_prix->id_produit = $this->produit->id;
        $autre_prix->save();

        //reset input
        $this->reset(['new_qte', 'new_prix']);

        //flash message
        session()->flash('add-success', 'Nouveau prix ajouté avec succès');
    }








    public function update_produit()
    {
        if ($this->produit) {
            $this->validate([
                'nom' => 'required|string',
                'prix' => 'required|numeric|gt:prix_achat',
                'prix_achat' => 'required|numeric',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp',
                'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
                'description' => 'nullable|string',
                'frais_inclu' => 'nullable|boolean',
                'id_categorie' => 'required|exists:categories,id',

            ]);



            $this->produit->nom = $this->nom;
            $this->produit->prix = $this->prix;
            $this->produit->prix_achat = $this->prix_achat;
            $this->produit->description = $this->description;
            $this->produit->id_categorie = $this->id_categorie;
            $this->produit->frais_inclu = $this->frais_inclu ? true : false;
            if ($this->photo) {
                //delete old photo
                if ($this->produit->photo) {
                    Storage::disk('public')->delete($this->produit->photo);
                }
                $this->produit->photo = $this->photo->store('produits', 'public');
            }

            if ($this->photos) {
                $photosPaths = [];
                foreach ($this->photos as $photo) {
                    $photosPaths[] = $photo->store('produits', 'public');
                }
                $this->produit->photos = json_encode($photosPaths);
            }
            $this->produit->save();


            $this->resetInput();

            return redirect()->route('produits')->with('success', "Produit modifié avec succès");
        }
    }










    public function resetInput()
    {
        $this->nom = '';
        $this->prix = '';
        $this->photo = '';
        $this->photos = '';
    }
}
