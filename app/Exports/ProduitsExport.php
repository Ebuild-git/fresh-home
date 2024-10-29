<?php

namespace App\Exports;


use App\Models\produits;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProduitsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    public function collection()
    {
        return produits::all();
    }

    // Définir les en-têtes de colonnes
    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Reference',
            'Prix',
            'Prix Achat',
            'Description',
            'Photo',
            'Stock',
            'Statut',
            'Created At',
            'Updated At'
        ];
    }

    // Mapper les données pour chaque colonne
    public function map($produit): array
    {
        return [
            $produit->id,
            $produit->nom,
            $produit->reference,
            $produit->prix,
            $produit->prix_achat,
            $produit->description,
            null,
            $produit->stock,
            $produit->statut,
            $produit->created_at,
            $produit->updated_at,
        ];
    }

    // Ajouter l'image pour chaque produit
    public function drawings()
    {
        $drawings = [];
        foreach ($this->collection() as $index => $produit) {
            if ($produit->photo) {
                $drawing = new Drawing();
                $drawing->setName('Produit Image');
                $drawing->setDescription('Image du produit');
                $drawing->setPath(storage_path('app/public/' . $produit->photo));
                $drawing->setHeight(60);
                $drawing->setCoordinates('G' . ($index + 2));
                $drawings[] = $drawing;
            }
        }
        return $drawings;
    }
}
