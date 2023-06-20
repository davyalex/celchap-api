<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produit;
use App\Models\Boutique;
use App\Models\Livraison;
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



        $produit = Produit::with(['categorie', 'sous_categorie', 'pointures' , 'tailles', 'couleurs', 'prices', 'avis', 'media'])
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
        $boutique = Boutique::with(['media', 'categorie', 'produits', 'commandes', 'user'])
            ->orderBy('name')->get();
        return response()->json([
            'boutique' => $boutique,
        ], 200);
    }

    //detail de la boutique selectionnée
    public function detailBoutique()
    {
        $boutiqueId = request('id');
        $boutique = Boutique::with([
            'media', 'categorie', 'commandes', 'user', 'produits'
            => fn ($q) => $q->with(['media', 'tailles','pointures' , 'couleurs', 'categorie']),
        ])->whereCode($boutiqueId)->first();


        return response()->json([
            'boutique' => $boutique,
        ], 200);
    }

    public function livraisonAll()
    {
        $livraison = Livraison::get();
           
        return response()->json([
            'livraison' => $livraison,
        ], 200);
    }
}
