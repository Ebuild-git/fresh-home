<?php

namespace App\Http\Controllers;

use App\Models\commandes;
use App\Models\gouvernorats;
use Illuminate\Support\Facades\Auth;
use App\Services\JaxService;

class JaxApi extends Controller
{

    protected $token;
    protected $apiUrl;
    protected $jaxService;

    public function __construct(JaxService $JaxService)
    {
        $this->token = config('app.client_jax_token');
        $this->apiUrl = config('app.jax_url_api');
        $this->jaxService = $JaxService;
    }

    public function refresh()
    {
       $this->jaxService->refresh();
       return redirect()->route('commandes')->with('success', "Recharge effectué !");
    }


    public function ImportGouvernoratsFromApi()
    {
        $response = $this->jaxService->GetAllGouvernorat();
        if ($response->successful()) {
            $data = $response->json();
            $data = response()->json($data);
            foreach ($data->original as $key => $value) {
                $gouv = gouvernorats::where('nom',$value['nom'])->first();
                if($gouv){
                    // le gouvernorat existe déjà, on met à jour l'id_in_api
                    $gouv->id_in_api = $value['id'];
                    $gouv->save();  
                }else{
                    // le gouvernorat n'existe pas, on le crée
                    $gouvernorat = new gouvernorats();
                    $gouvernorat->nom = $value['nom'];
                    $gouvernorat->id_in_api = $value['id'];
                    $gouvernorat->save();
                }
            }
            return 'Les gouvernorats ont été enregistrés avec succès';
        } else {    
            return response()->json(['error' => 'Erreur lors de la requête'], $response->status());
        }

       
    }
}
