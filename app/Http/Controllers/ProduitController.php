<?php
//produit de la boutique
namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Grossiste;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;

class ProduitController extends Controller
{

    public function index()
    {
        //
        $produit = Produit::where('boutique_id', Auth::user()->boutique_id)
            ->with(['categorie', 'sous_categorie', 'grossistes', 'avis', 'media'])->get();
        return response()->json(['produit' => $produit], 200);
    }




    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'prix_vendeur' => 'required',
            'prix_promo' => '',
            'date_debut_promo' => '',
            'date_fin_promo' => '',
            'disponibilite' => '',
            'description' => '',
            'sous_category' => '',
            'category' => 'required',
        ]);

        $code = Str::random(5);

        //intervalle montant a ajouter
        $montant_ajouter = 0;
        if ($request['prix_vendeur'] <= 5000) {
            $montant_ajouter += 500;
        } elseif ($request['prix_vendeur'] == 6000 || $request['prix_vendeur'] <= 15000) {
            $montant_ajouter += 1500;
        } else {
            $montant_ajouter += 2000;
        }

        //prix_afficher
        $prix_afficher = $request['prix_vendeur'] + $montant_ajouter;

        $produit = Produit::firstOrCreate([
            'code' => $code,
            'name' => $request['name'],
            'prix_vendeur' => $request['prix_vendeur'],
            'montant_ajouter' => $montant_ajouter,
            'prix_afficher' =>  $prix_afficher,
            'date_fin_promo' => $request['date_fin_promo'],
            'disponibilite' => $request['disponibilite'],
            'description' => $request['description'],
            'category_id' => $request['category'],
            'sous_category_id' => $request['sous_category'],
            'boutique_id' => Auth::user()->boutique_id,
        ]);

        if ($produit) {
            if ($request->file('image')) {
                foreach ($request->file('image') as $image) {
                    $produit->addMedia($image)
                        ->toMediaCollection('image');
                }
            }

            if ($request['grossiste']) {
                foreach ($request['grossiste'] as $value) {
                    Grossiste::create([
                        'produit_id' => $produit['id'],
                        'nombre' => $value['nombre'],
                        'prix' => $value['prix']
                    ]);
                }
            }
        }

        $produit = Produit::where('boutique_id', Auth::user()->boutique_id)
        ->with(['categorie', 'sous_categorie', 'grossistes', 'avis', 'media'])
        ->whereId($produit['id'])
        ->get();

        return response()->json([
            'message' => 'Produit enregistré avec success',
            'produit' => $produit
        ], 200);
    }




    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'prix_vendeur' => 'required',
            'prix_promo' => '',
            'date_debut_promo' => '',
            'date_fin_promo' => '',
            'disponibilite' => '',
            'description' => '',
            'sous_category' => '',
            'category' => 'required',

        ]);

        //intervalle montant a ajouter
        $montant_ajouter = 0;
        if ($request['prix_vendeur'] <= 5000) {
            $montant_ajouter += 500;
        } elseif ($request['prix_vendeur'] == 6000 || $request['prix_vendeur'] <= 15000) {
            $montant_ajouter += 1500;
        } else {
            $montant_ajouter += 2000;
        }

        //prix_afficher
        $prix_afficher = $request['prix_vendeur'] + $montant_ajouter;

        $produit = tap(Produit::find($request->id))->update([
            'name' => $request['name'],
            'prix_vendeur' => $request['prix_vendeur'],
            'montant_ajouter' => $montant_ajouter,
            'prix_afficher' =>  $prix_afficher,
            'date_fin_promo' => $request['date_fin_promo'],
            'disponibilite' => $request['disponibilite'],
            'description' => $request['description'],
            'category_id' => $request['category'],
            'sous_category_id' => $request['sous_category'],
            'boutique_id' => Auth::user()->boutique_id,
        ]);

  
        if ($request->file('files')) {
            foreach ($request->file('files') as $image) {
                $produit->addMedia($image)
                    ->toMediaCollection('image');
            }
        }
      
        if ($request['grossiste']) {
            Grossiste::where('produit_id',$request['id'])->delete();
            foreach ($request['grossiste'] as $value) {
                Grossiste::create([
                    'produit_id' => $produit['id'],
                    'nombre' => $value['nombre'],
                    'prix' => $value['prix']
                ]);
            }
        }

        $produit = Produit::where('boutique_id', Auth::user()->boutique_id)
        ->with(['categorie', 'sous_categorie', 'grossistes', 'avis', 'media'])
        ->whereId($produit['id'])
        ->get();

        return response()->json([
            'message' => 'Produit modifié avec success',
            'produit' => $produit
        ], 200);
    }


    public function destroy(Request $request)
    {
        //
        Produit::find($request->id)->delete();
        Grossiste::where('produit_id',$request->id)->delete();
        DB::table('media')->where('model_id', $request->id)->delete();
        return response()->json(['message' => 'produit supprimé'], 200);
    }


    public function deleteImage(Request $request)
    {
        //
        $delete = DB::table('media')->whereId($request['image'])->delete();

        return response()->json("suppression réussi");
    }
}
