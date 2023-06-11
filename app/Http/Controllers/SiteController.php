<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produit;
use App\Models\Boutique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function produit(Request $request)
    {
        //produit recent du jour
        $filter = request('produit');
        $categorie = request('categorie');
        $sous_categorie = request('sous-categorie');



        $produit = Produit::with(['categorie', 'sous_categorie', 'prices', 'avis', 'media'])
            ->when($filter == 'produit_jour', function ($q) {
                return $q->whereDay('created_at', Carbon::now()->day);
            })
            ->when(
                $categorie,
                fn ($q) => $q->where('category_id', $categorie)
            )
            ->when(
                $sous_categorie,
                fn ($q) => $q->where('sous_category_id', $sous_categorie)
            )
            ->orderBy('created_at', 'desc')->get();


        return response()->json(['produit' => $produit], 200);
    }




    //recuperation des produits en fonction de la categorie




    //liste de toute les boutiques
    public function boutiqueAll()
    {
        $boutique = Boutique::with(['media', 'categorie', 'produits', 'commandes'])
            ->orderBy('name')->get();
        return response()->json([
            'boutique' => $boutique,
        ], 200);
    }
}
