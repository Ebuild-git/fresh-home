<?php

namespace App\Providers;

use App\Models\config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Partage des informations globales avec toutes les vues
        view()->composer('*', function ($view) {
            // Exemple de récupération d'une configuration globale
            $view->with('infos', Config::first());
        });
    }
}
