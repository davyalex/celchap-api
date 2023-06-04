<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produit;
use App\Models\Boutique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    //
    public function produit(Request $request)
    {
        $filter = request('produit');

        $produit = Produit::with(['categorie', 'sous_categorie', 'prices', 'avis', 'media'])
            ->when($filter == 'produit_jour', function ($q) {
                return $q->whereDay('created_at', Carbon::now()->day);
            })
            ->get();

        return response()->json(['produit' => $produit], 200);
    }



    public function boutiqueAll()
    {
        $boutique = Boutique::with(['media', 'categorie', 'produits', 'commandes'])
        ->orderBy('name')->get();
        return response()->json([
            'boutique' => $boutique,
        ], 200);
    }
}
