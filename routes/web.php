<?php

use App\Http\Controllers\admin\BoutiqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategorieController;
use App\Http\Controllers\admin\LivraisonController;
use App\Http\Controllers\admin\SousCategorieController;

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



Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

       /**CATEGORY PRINCIPALE */
       Route::controller(CategorieController::class)->prefix('categorie')->group(function () {
        route::get('index', 'index')->name('admin.categorie.index');
        route::get('create', 'create')->name('admin.categorie.create');
        route::post('store', 'store')->name('admin.categorie.store');
        route::post('update/{id}', 'update')->name('admin.categorie.update');
        route::get('destroy/{id}', 'destroy')->name('admin.categorie.destroy');
    });

    
    /**SOUS CATEGORY  */
    Route::controller(SousCategorieController::class)->prefix('sous-categorie')->group(function () {
        route::get('index', 'index')->name('admin.sous_categorie.index');
        route::get('create', 'create')->name('admin.sous_categorie.create');
        route::post('store', 'store')->name('admin.sous_categorie.store');
        route::post('update/{id}', 'update')->name('admin.sous_categorie.update');
        route::get('destroy/{id}', 'destroy')->name('admin.sous_categorie.destroy');
    });

       /**LIVRAISON  */
       Route::controller(LivraisonController::class)->prefix('livraison')->group(function () {
        route::get('index', 'index')->name('admin.livraison.index');
        route::post('store', 'store')->name('admin.livraison.store');
        route::post('update/{id}', 'update')->name('admin.livraison.update');
        route::post('destroy/{id}', 'destroy')->name('admin.livraison.destroy');
    });


      /**UTILISATEURS  */
      Route::controller(UserController::class)->prefix('utilisateur')->group(function () {
        route::get('fournisseur', 'fournisseur')->name('admin.fournisseur');
        route::get('detail_fournisseur/{id}', 'detail_fournisseur')->name('admin.detail_fournisseur');

        // route::post('store', 'store')->name('admin.livraison.store');
        // route::post('update/{id}', 'update')->name('admin.livraison.update');
        // route::post('destroy/{id}', 'destroy')->name('admin.livraison.destroy');
    });

     /**BOUTIQUE  */
     Route::controller(BoutiqueController::class)->prefix('boutique')->group(function () {
        route::get('index', 'index')->name('admin.boutique');
        route::get('detail/{id}', 'detail')->name('admin.boutique_detail');

        // route::post('store', 'store')->name('admin.livraison.store');
        // route::post('update/{id}', 'update')->name('admin.livraison.update');
        // route::post('destroy/{id}', 'destroy')->name('admin.livraison.destroy');
    });
});
