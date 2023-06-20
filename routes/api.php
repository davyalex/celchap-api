<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\GrossisteController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//register

Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('auth', 'auth')->middleware('auth:sanctum');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});




Route::middleware(['auth:sanctum'])->group(function () {


    /**BOUTIQUE */
    Route::controller(BoutiqueController::class)->prefix('boutique')->group(function () {
        route::get('index', 'index');
        route::post('select', 'select');
        route::post('store', 'store');
        route::post('update', 'update');
        route::post('destroy', 'destroy');
    });

    /**PRODUIT */
    Route::controller(ProduitController::class)->prefix('produit')->group(function () {
        route::get('index', 'index');
        route::post('store', 'store');
        route::get('detail', 'detail');
        route::post('update', 'update');
        route::post('destroy', 'destroy');
        route::post('deleteImage', 'deleteImage');
    });


    /**COMMANDE */
    Route::controller(CommandeController::class)->prefix('commande')->group(function () {
        route::get('index', 'index');
        route::post('store', 'store');
        route::get('detail', 'detail');
        route::get('client', 'commande_user');
        route::post('destroy', 'destroy');
    });
});



//api sans middleware

//api du site

/**SITE */
Route::controller(SiteController::class)->prefix('site')->group(function () {
    route::get('produit', 'produit');
    route::get('liste-boutique', 'boutiqueAll');
    route::get('boutique', 'detailBoutique');
    route::get('liste-livraison', 'livraisonAll');
});



//liste des categories
Route::get('categorie/index', [CategorieController::class, 'index']);





//api admin

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    /**CATEGORY PRINCIPALE */
    Route::controller(CategorieController::class)->prefix('categorie')->group(function () {
        route::get('index', 'index');
        route::post('store', 'store');
        route::post('update', 'update');
        route::post('destroy', 'destroy');
    });

    /**SOUS CATEGORY  */
    Route::controller(SousCategorieController::class)->prefix('sous_categorie')->group(function () {
        route::get('index', 'index');
        route::post('store', 'store');
        route::post('update', 'update');
        route::post('destroy', 'destroy');
    });


    /**LIVRAISON  */
    Route::controller(LivraisonController::class)->prefix('livraison')->group(function () {
        route::get('index', 'index');
        route::post('store', 'store');
        route::post('update', 'update');
        route::post('destroy', 'destroy');
    });


    /**ADMIN  */
    Route::controller(AdminController::class)->group(function () {
        route::get('liste-boutique', 'boutique');
        route::get('user', 'user'); //envoi de parametre query "role"
       
    });
});
