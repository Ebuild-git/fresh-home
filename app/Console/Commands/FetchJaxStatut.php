<?php

namespace App\Console\Commands;

use App\Models\commandes;
use App\Services\JaxService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchJaxStatut extends Command
{

    protected $jaxService;

    public function __construct(JaxService $JaxService)
    {
        $this->jaxService = $JaxService;
    }




    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-jax-statut';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exécute une route spécifique toutes les 4 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commandes = commandes::whereNotNull('code_in_api')
            ->where('statut', '!=', 'Livré')
            ->where('etat', 'confirmé')
            ->get();
        foreach ($commandes as $commande) {
            $data = $this->jaxService->GetStatutColis($commande->code_in_api);
            $statut = $data->original;
            $commande->statut = $statut;
            $commande->save();
        }
    }
}
