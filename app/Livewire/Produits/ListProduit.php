<?php

namespace App\Livewire\Produits;

use App\Models\categories;
use App\Models\produits;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduit extends Component
{

    protected $listeners = ['add-stock' => '$refresh'];
    use WithPagination;
    public $key, $id_categorie;




    public function toggleBestSell($produitId)
    {
        $produit = produits::findOrFail($produitId);
        $produit->best_sell = !$produit->best_sell;
        $produit->save();
    }


    public function render()
    {
        $Query = produits::orderBy('id', "Desc");
        if (!is_null($this->key)) {
            $Query->where('nom', 'like', '%' . $this->key . '%');
        }
        if (!is_null($this->id_categorie)) {
            $Query->where('id_categorie', $this->id_categorie);
        }
        $produits = $Query
            ->select('id', 'id_categorie', 'nom', 'prix', 'prix_achat', 'created_at', 'frais_inclu', 'best_sell', 'stock', 'photo', 'reference', 'id_promotion')
            ->paginate(30);
        $total = produits::count();
        $total_supprimers = produits::onlyTrashed()->count();
        $categories = categories::select("id", "nom")->get();
        return view('livewire.produits.list-produit', compact('produits', 'total', 'total_supprimers', 'categories'));
    }




    public function delete($id)
    {
        $produit = produits::find($id);
        if ($produit) {
            $produit->delete();
            session()->flash('info', 'Produit supprimé avec succès');
        }
    }



    public function filtrer()
    {
        //reset page
        $this->resetPage();
    }
}
