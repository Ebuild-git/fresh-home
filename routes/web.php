<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Init;
use App\Http\Controllers\JaxApi;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PayementController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['check.country.cookie'])->group(function () {




    Route::get('/change-lang/{lang}', function ($lang) {
        if (in_array($lang, ['en', 'fr'])) {
            session(['locale' => $lang]);
        }
        return redirect()->back();
    })->name('change.lang');



    Route::get('/view_produit/{id}', [HomeController::class, 'view_produit']);
    Route::get('/set-cookie/{pays}', [HomeController::class, 'set_cookie']);
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('/login', [FrontController::class, 'login'])->name('login');
    Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
    Route::get('/shop_live', [FrontController::class, 'shop_live'])->name('shop_live');
    Route::get('/about', [FrontController::class, 'about'])->name('about');
    Route::get('/produit/{id}/{slug}', [FrontController::class, 'produit'])->name('produit');
    Route::get('/password.reset/token', [FrontController::class, 'password_reset'])->name('password.reset');
    Route::get('/forgotpassword', [FrontController::class, 'forgotpassword'])->name('forgotpassword');
    Route::get('/print/commande/{id}', [HomeController::class, 'print_commande'])->name('print_commande');
    Route::get('/print/commande2/{token}', [HomeController::class, 'print_commande2'])->name('print_commande2');
    Route::get('/print_bordereau', [HomeController::class, 'print_bordereau'])->name('print_bordereau');
    Route::get('/error-page', [FrontController::class, 'error_page'])->name('error-page');
    Route::post('/client/ajouter_favoris', [FavorisController::class, 'add']);
    Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');
    Route::post('/commander', [PayementController::class, 'commander'])->name('commander');


    //route de gestion du panier
    Route::post('/client/ajouter_au_panier', [PanierController::class, 'add']);
    Route::post('/client/cart/delete', [PanierController::class, 'delete']);
    Route::get('/client/get', [PanierController::class, 'count_panier']);
    Route::get('/cart', [PanierController::class, 'cart'])->name('cart');


    //gestion des contact et formulaires
    Route::resource('/front-contact', ContactController::class);


    // Route du client
    Route::middleware(['auth'])->group(function () {

        Route::get('/profile', [FrontController::class, 'profile'])->name('profile');

        //paiement et facture
        Route::get('/payment-success/{token}', [PayementController::class, 'payment_success'])->name('payment-success');
        Route::get('/payment-failure', [PayementController::class, 'payment_failure'])->name('payment-failure');


        //gestions des favoris
        Route::get('/favoris', [FavorisController::class, 'index'])->name('favoris_index');
        Route::post('/favoris/add', [FavorisController::class, 'add'])->name('favoris_add');
        Route::get('/favoris/get', [FavorisController::class, 'get'])->name('favoris_get');
        Route::DELETE('/favoris/delete', [FavorisController::class, 'delete'])->name('favoris_delete');
    });
});


Route::get('/init', [JaxApi::class, 'ImportGouvernoratsFromApi'])->name('init');
Route::get('/refresh-statut', [JaxApi::class, 'refresh'])->name('init-refresh');




Route::middleware(['auth'])->group(function () {
    Route::get('/open_url_notification', [AdminController::class, 'open_url_notification'])
        ->name('open_url_notification');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');
    Route::post('/dashboard/filtre', [AdminController::class, 'dashboard'])
        ->name('filtre-dashboard');

    Route::get('/admin/produits', [AdminController::class, 'produits'])
        ->name('produits')
        ->middleware('permission:product_view');

    Route::get('/admin/corbeille', [AdminController::class, 'corbeille'])->name('corbeille');
    Route::get('/admin/produit/{id}/update', [AdminController::class, 'produits_update'])
        ->name('produits.update')
        ->middleware('permission:product_edit');

    Route::get('/admin/produit/{id}/historique', [AdminController::class, 'historique'])
        ->name('produits.historique')
        ->middleware('role:admin');


    Route::get('/admin/produit/add', [AdminController::class, 'produit_add'])
        ->name('produit.add')
        ->middleware('permission:product_add');

    Route::get('/admin/commandes', [AdminController::class, 'commandes'])
        ->name('commandes')
        ->middleware('permission:order_view');
    Route::get('/admin/parametres', [AdminController::class, 'parametres'])
        ->name('parametres');

    Route::get('/admin/personnels', [AdminController::class, 'personnels'])
        ->name('personnels')
        ->middleware('role:admin');
    Route::get('/admin/promotions', [AdminController::class, 'promotions'])
        ->name('promotions');
    Route::get('/admin/promotions/{id}', [AdminController::class, 'promotions'])
        ->name('promotions_produit');
    Route::get('/admin/commande/{id}', [AdminController::class, 'details_commande'])
        ->name('details_commande');
    Route::get('clients', [AdminController::class, 'clients'])
        ->name('clients')
        ->middleware('permission:clients_view');

    Route::get('/admin/export/clients', [AdminController::class, 'export_clients'])
        ->name('export_clients')
        ->middleware('permission:clients_view');

    Route::get('contact-admin', [AdminController::class, 'contact_admin'])
        ->name('contact-admin')
        ->middleware('permission:setting_view');


    Route::post('contact-admin.post', [AdminController::class, 'contact_admin_update'])
        ->name('contact-admin.post')
        ->middleware('permission:setting_view');


    Route::get('/admin/get_live_notifications', [AdminController::class, 'live_notifications'])
        ->name('live_notifications');

    Route::post('/update-config', [AdminController::class, 'update_config'])
        ->name('update-config');

    Route::get('admin/new_commande', [AdminController::class, 'new_commande'])
        ->name('new_commande')
        ->middleware('permission:order_add');

    Route::post('admin/add_note', [AdminController::class, 'add_note'])
        ->name('add_note')
        ->middleware('permission:order_edit');


    Route::get('/admin/commande/{id}/edit_commande', [AdminController::class, 'edit_commande'])
        ->name('edit_commande')
        ->middleware('permission:order_edit');

    Route::get('/admin/personnel/delete/{id}', [AdminController::class, 'delete_personnel'])
        ->name('delete_personnel')
        ->middleware('role:admin');

    Route::get('/admin/config-about', [AdminController::class, 'config_about'])
        ->name('config-about')
        ->middleware('role:admin');

    Route::post('/admin/config-about.store', [AdminController::class, 'config_about_store'])
        ->name('config-about.post')
        ->middleware('role:admin');

    Route::resource('banners', BannerController::class)->middleware('role:admin');

    Route::post('/admin/update-personnel-permissions', [AdminController::class, 'update_permission'])
        ->name('update-personnel-permissions')
        ->middleware('role:admin');


    Route::get('/admin/delete-all-notifications', [AdminController::class, 'delete_all_notifications'])
        ->name('delete-all-notifications');


    //gestion des categories
    Route::get('/admin/categories', [CategoriesController::class, 'categories'])
        ->name('categories');
});
