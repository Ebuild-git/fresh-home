<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GouvernoratsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gouvernorats = [
            'Tunis',
            'Ariana',
            'Ben Arous',
            'Manouba',
            'Nabeul',
            'Zaghouan',
            'Bizerte',
            'Beja',
            'Jendouba',
            'Kef',
            'Siliana',
            'Sousse',
            'Monastir',
            'Mahdia',
            'Sfax',
            'Kairouan',
            'Kasserine',
            'Sidi Bouzid',
            'Gabes',
            'Mednine',
            'Tataouine',
            'Gafsa',
            'Tozeur',
            'Kebili'
        ];

        foreach ($gouvernorats as $key => $nom) {
            DB::table('gouvernorats')->insert([
                'nom' => $nom,
                'id_in_api' => $key + 1, // Incrémentation automatique de id_in_api
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
