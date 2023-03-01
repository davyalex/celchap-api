<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousCategorieController;

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
});

Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware(['auth:sanctum'])->group(function () {

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
        route::post('update', 'update');
        route::post('destroy', 'destroy');
        route::post('deleteImage', 'deleteImage');

    });

        /**GROSSISTE */
        Route::controller(GrossisteController::class)->prefix('produit')->group(function () {
            route::get('index', 'index');
            route::post('store', 'store');
            route::post('update', 'update');
            route::post('destroy', 'destroy');    
        });
});
