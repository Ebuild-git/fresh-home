<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;


    public function produits(){
        return $this->hasMany(produits::class, 'id_categorie','id');
    }


}
