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
        $produitsQuery = produits::query();

        if ($paginate) {
            $produits = $produitsQuery->paginate($paginate);
        } else {
            $produits = $produitsQuery->get();
        }

        $generator = new BarcodeGeneratorPNG();

        $produits = $produits->map(function ($produit) use ($generator) {
            $ean13 = $produit->reference ?? '';
            $barcodeBase64 = null;
            if (strlen($ean13) == 13 && ctype_digit($ean13)) {
                try {
                    $barcode = $generator->getBarcode($ean13, $generator::TYPE_EAN_13);
                    $barcodeBase64 = 'data:image/png;base64,' . base64_encode($barcode);
                } catch (\Exception $e) {
                    $barcodeBase64 = null;
                }
            } else {
                $barcodeBase64 = null;
            }

            return [
                'Sku' => $produit->reference,
                'Ean13' => $barcodeBase64,
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
}
