<?php

namespace App\Http\Controllers;

use App\Models\gouvernorats;
use App\Models\produits;
use Illuminate\Http\Request;

class Init extends Controller
{
    protected $JaxApi;

    public function __construct(JaxApi $JaxApi)
    {
        $this->JaxApi = $JaxApi;
    }


    // enregistrer les gouvernorats venant de l'api de livraion
    public function store()
    {
        $response = $this->JaxApi->GetAllGouvernorat();
        if ($response->successful()) {
            $data = $response->json();
            $data = response()->json($data);
            foreach ($data->original as $key => $value) {
                $gouvernorat = new gouvernorats();
                $gouvernorat->nom = $value['nom'];
                $gouvernorat->id_in_api = $value['id'];
                $gouvernorat->save();
            }
            return 'Les gouvernorats ont été enregistrés avec succès';
        } else {    
            return response()->json(['error' => 'Erreur lors de la requête'], $response->status());
        }

       
    }


    public function import()
    {
        $data = [

            [
                "code_bar" => 6192423908484,
                "categorie" => "brume",
                "nom" => "seduction ",
                "prix_vente" => 35,
                "prix_achat" => 18,
                "nombre" => 52,
                "description" => "Découvrez \"Seduction\" de My Story, une brume captivante au parfum envoûtant de vanille."
            ],
            [
                "code_bar" => 6192423908576,
                "categorie" => "brume",
                "nom" => "paradise ",
                "prix_vente" => 35,
                "prix_achat" => 18,
                "nombre" => 28,
                "description" => "Revivez l’ambiance des nuits d’été avec notre brume fruitée Paradise."
            ],
            [
                "code_bar" => 6192423908491,
                "categorie" => "brume",
                "nom" => "sexy ",
                "prix_vente" => 35,
                "prix_achat" => 18,
                "nombre" => 2,
                "description" => "La brume \"Sexy\" de My Story marie subtilement des notes florales sucrées."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "lover ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 11,
                "description" => "LOVER, Reflet d'un souffle d'exception, symbole d'un parfum irrésistible et mystérieux dédiée aux femmes fatales."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "cherry ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 10,
                "description" => "Cherry l'Eau de Parfum pour femme de s'adresse à des femmes authentiques."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "proud ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 21,
                "description" => "PROUD est le parfum qui vous emmène au jardin londonien après la pluie."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "eternal ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 30,
                "description" => "ETERNAL est une histoire d'énergie, d'excitation, de sophistication, d'élégance, de rêves à réaliser"
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "devine ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 8,
                "description" => "DEVINE est pour une femme forte et audacieuse, qui revendique sa liberté"
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "diva ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 47,
                "description" => "Diva est une fragrance irrésistible, incarnant une élégance intemporelle et une sophistication audacieuse. Son ouverture fraîche et lumineuse mène à un cœur floral opulent, tandis que sa base riche et chaleureuse laisse une empreinte durable et captivante. Parfait pour celles qui veulent se démarquer avec une aura de charme et de raffinement inégalé."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "ego ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 4,
                "description" => "EGO est un parfum dédiée aux hommes hédonistes et flamboyants qui savent saisir leur chance et défier leur destin."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "no limits ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 16,
                "description" => "Une masculinité nouvelle est révelée par l'Eau de Parfum NO LIMITS."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "loyal ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 6,
                "description" => "L'eau de parfums LOYAL est un choc phénoménal entre fraîcheur mordante et sensualité animale."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "sharp ",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 8,
                "description" => "SHARP est Un parfum frais, brûlant, obsédant qui fait monter la tension et désoriente les sens."
            ],
            [
                "code_bar" => 6192423908453,
                "categorie" => "parfum",
                "nom" => "oriental",
                "prix_vente" => 79,
                "prix_achat" => 18,
                "nombre" => 17,
                "description" => "Oriental est le parfum UNISEX envoûtant de 100 mL qui débute par une touche vive de bergamote, évoquant une fraîcheur méditerranéenne."
            ],
            [
                "code_bar" => 6192423908620,
                "categorie" => "parfum d'ambiance",
                "nom" => "Freshness",
                "prix_vente" => 29.9,
                "prix_achat" => 8,
                "nombre" => 18,
                "description" => "Adoptez le parfum propre et apaisant de Freshness. Inspiré par l'arôme classique du savon Dove"
            ],
            [
                "code_bar" => 6192423908613,
                "categorie" => "parfum d'ambiance",
                "nom" => "Lemonade",
                "prix_vente" => 29.9,
                "prix_achat" => 8,
                "nombre" => 19,
                "description" => "Expérimentez une explosion de fraîcheur citronnée avec Lemonade."
            ],
            [
                "code_bar" => 6192423908637,
                "categorie" => "parfum d'ambiance",
                "nom" => "Tropical island",
                "prix_vente" => 29.9,
                "prix_achat" => 8,
                "nombre" => 12,
                "description" => "Évadez-vous vers un paradis tropical avec Tropical Island."
            ],
            [
                "code_bar" => 6192423908460,
                "categorie" => "gamme capillaire",
                "nom" => "shampoing ",
                "prix_vente" => 33,
                "prix_achat" => 8.5,
                "nombre" => 3,
                "description" => "Shampoing GLOW UP sans sulfate et sans sel au pouvoir nourrissant pour une action efficace sur la fibre capillaire après un lissage brésilien ou un soin capillaire."
            ],
            [
                "code_bar" => 6192423908477,
                "categorie" => "gamme capillaire",
                "nom" => "après shampoing ",
                "prix_vente" => 33,
                "prix_achat" => 7.5,
                "nombre" => 10,
                "description" => "Aprés-Shampoing GLOW UP aux Protéines végétales et au huile d'argan. Idéal pour cheveux traités, colorés endommagés et ultra-sensibilisés."
            ],
            [
                "code_bar" => 6192423908514,
                "categorie" => "gamme capillaire",
                "nom" => "Liss Pro",
                "prix_vente" => 75,
                "prix_achat" => 20,
                "nombre" => 8,
                "description" => " Plongez dans une expérience de soin luxueuse et redonnez vie à vos cheveux avec notre pack protéine Collagène, caviar et protéines végétales."
            ],
            [
                "code_bar" => 6192423908507,
                "categorie" => "gamme capillaire",
                "nom" => "serum ",
                "prix_vente" => 29.9,
                "prix_achat" => 10,
                "nombre" => 25,
                "description" => "serum Hydratant à la kératine et l'huile d'argon Réparateur répare les cheuveux abimés et cassés "
            ],
            [
                "code_bar" => 6192423908590,
                "categorie" => "gamme pour le corps",
                "nom" => "lait de corps",
                "prix_vente" => 29.9,
                "prix_achat" => 10,
                "nombre" => 7,
                "description" => "ce lait de corps hydratant « Floral Paradise » est délicatement parfumé et rend la peau souple, douce et confortable. Il hydrate, apaise et assouplit la peau grâce à sa formule riche en huile d'argan et beurre de karité."
            ],
            [
                "code_bar" => 6192423908606,
                "categorie" => "gamme pour le corps",
                "nom" => "gommage",
                "prix_vente" => 35,
                "prix_achat" => 15,
                "nombre" => 6,
                "description" => "Ce gommage est un soin précieux multifonctions qui élimine les impuretés, nettoie parfaitement votre peau et unifie votre teint."
            ],
            [
                "code_bar" => 61924239008583,
                "categorie" => "huile",
                "nom" => "magic oil",
                "prix_vente" => 49,
                "prix_achat" => 23,
                "nombre" => 38,
                "description" => "Magic Oil l’huile sèche pailletée est un élixir luxueux qui offre une hydratation intense tout en laissant la peau subtilement scintillante."
            ]

        ];


        foreach ($data as $key => $value) {
            $code = $value['code_bar'];
            $produit = new produits();
            $produit->nom = $value['nom'];
            $produit->prix = $value['prix_vente'];
            $produit->prix_achat = $value['prix_achat'];
            $produit->stock = $value['nombre'];
            $produit->description = $value['description'];
            $produit->reference = $value['code_bar'];
            $produit->save();
        }
        echo "Produits importés avec succès!";
    }
}
