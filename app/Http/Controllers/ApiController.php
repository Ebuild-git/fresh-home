<?php

namespace App\Http\Controllers;

use App\Models\produits;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;


class ApiController extends Controller
{
    public function get_produits(Request $request)
    {
        $paginate = $request->input("paginate") ?? null;
        $produitsQuery = produits::select('id', 'reference', 'stock', 'prix', 'id_promotion');

        if ($paginate) {
            $produits = $produitsQuery->paginate($paginate);
        } else {
            $produits = $produitsQuery->get();
        }


        $produits = $produits->map(function ($produit) {
            return [
                'produit_id' => $produit->id,
                'Sku' => $produit->reference,
                'Ean13' => $this->generateEAN($produit->reference),
                'Quantite' => $produit->stock,
                'Prix' => $produit->getPrice(),
                'PrixAvantReduction' => $produit->id_promotion ? $produit->prix : null,
                'IsPormotion' => $produit->id_promotion ? true : false,
            ];
        });


        if ($paginate) {
            return response()->json([
                'data' => $produits,
                'current_page' => $produits->currentPage(),
                'last_page' => $produits->lastPage(),
                'per_page' => $produits->perPage(),
                'total' => $produits->total()
            ]);
        } else {
            return response()->json($produits);
        }
    }



    function generateEAN($number)
    {
        $code = '200' . str_pad($number, 9, '0');
        $weightflag = true;
        $sum = 0;
        for ($i = strlen($code) - 1; $i >= 0; $i--) {
            $sum += (int)$code[$i] * ($weightflag ? 3 : 1);
            $weightflag = !$weightflag;
        }
        $code .= (10 - ($sum % 10)) % 10;
        return $code;
    }
}
