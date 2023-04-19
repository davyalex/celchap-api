<?php
//produit de la boutique
namespace App\Http\Controllers;

use App\Models\Price;
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
        //request Query : name,prix,categorie;

        $name = request('name');
        $prix = request('prix');
        $categorie = request('categorie');

        $filter = request('filter');



        $produit = Produit::where('boutique_id', Auth::user()->boutique_id)
            ->with(['categorie', 'sous_categorie', 'prices', 'avis', 'media'])
            ->when(
                $name,
                fn ($q) => $q->whereName($name)
            )

            ->when(
                $prix,
                fn ($q) => $q->where('prix_vendeur', $prix)
            )

            ->when(
                $categorie,
                fn ($q) => $q->where('category_id', $categorie)
            )

            ->when(
                $filter,
                fn ($q) => $q
                    ->where('name', 'Like', "%{$filter}%")
                    ->orWhere('prix_vendeur', 'Like', "%{$filter}%")
                    ->where('boutique_id', Auth::user()->boutique_id)
            )

            ->get();
        return response()->json(['produit' => $produit], 200);
    }




    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            // 'prix_vendeur' => 'required',
            // 'prix_promo' => '',
            // 'date_debut_promo' => '',
            // 'date_fin_promo' => '',
            'disponibilite' => '',
            'description' => '',
            'sous_category' => '',
            'category' => 'required',
        ]);

        $code = Str::random(5);

        $produit = Produit::firstOrCreate([
            'code' => $code,
            'name' => $request['name'],
            'type' => $request['type'],
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

            /**
             * type: detail ou gros
             */


            //if type_produit ==detail
            if ($request['type'] == 'detail') {

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

                //add info in table
                Price::create([
                    'produit_id' => $produit['id'],
                    'q_min' => 1,
                    'q_max' => 1,
                    'prix_vendeur' => $request['prix_vendeur'],
                    'montant_ajouter' => $montant_ajouter,
                    'prix_afficher' =>  $prix_afficher
                ]);
            }


            //if type_produit ==gros
            if ($request['type'] == 'gros') {
                foreach ($request['gros'] as $value) {

                    //intervalle montant a ajouter
                    $montant_ajouter = 0;
                    if ($value['prix_vendeur'] <= 5000) {
                        $montant_ajouter += 500;
                    } elseif ($value['prix_vendeur'] == 6000 || $value['prix_vendeur'] <= 15000) {
                        $montant_ajouter += 1500;
                    } else {
                        $montant_ajouter += 2000;
                    }

                    //prix_afficher
                    $prix_afficher = $value['prix_vendeur'] + $montant_ajouter;


                    //add info in table

                    Price::create([
                        'produit_id' => $produit['id'],
                        'q_min' => $value['q_min'],
                        'q_max' => $value['q_max'],
                        'prix_vendeur' => $value['prix_vendeur'],
                        'montant_ajouter' => $montant_ajouter,
                        'prix_afficher' =>  $prix_afficher
                    ]);
                }
            }
        }

        $produit = Produit::where('boutique_id', Auth::user()->boutique_id)
            ->with(['categorie', 'sous_categorie', 'prices', 'avis', 'media'])
            ->whereId($produit['id'])
            ->get();

        return response()->json([
            'message' => 'Produit enregistré avec success',
            'produit' => $produit
        ], 200);
    }


    public function detail(Request $request)
    {

        //recuperer les detail d'un produit

        $produit  = Produit::whereId($request['id'])
            ->with(['categorie', 'sous_categorie', 'prices', 'avis', 'media'])->get();

        return response()->json(['produit' => $produit], 200);
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



        $produit = tap(Produit::find($request->id))->update([
            'name' => $request['name'],
            'type' => $request['type'],
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

        /**
         * type: detail ou gros
         */


        //if type_produit ==detail
        if ($request['type'] == 'detail') {

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

            //add info in table
            Price::create([
                'produit_id' => $produit['id'],
                'q_min' => 1,
                'q_max' => 1,
                'prix_vendeur' => $request['prix_vendeur'],
                'montant_ajouter' => $montant_ajouter,
                'prix_afficher' =>  $prix_afficher
            ]);
        }


        //if type_produit ==gros
        if ($request['type'] == 'gros') {
            foreach ($request['gros'] as $value) {

                //intervalle montant a ajouter
                $montant_ajouter = 0;
                if ($value['prix_vendeur'] <= 5000) {
                    $montant_ajouter += 500;
                } elseif ($value['prix_vendeur'] == 6000 || $value['prix_vendeur'] <= 15000) {
                    $montant_ajouter += 1500;
                } else {
                    $montant_ajouter += 2000;
                }

                //prix_afficher
                $prix_afficher = $value['prix_vendeur'] + $montant_ajouter;


                //add info in table

                Price::create([
                    'produit_id' => $produit['id'],
                    'q_min' => $value['q_min'],
                    'q_max' => $value['q_max'],
                    'prix_vendeur' => $value['prix_vendeur'],
                    'montant_ajouter' => $montant_ajouter,
                    'prix_afficher' =>  $prix_afficher
                ]);
            }
        }

        $produit = Produit::where('boutique_id', Auth::user()->boutique_id)
            ->with(['categorie', 'sous_categorie', 'prices', 'avis', 'media'])
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
        Grossiste::where('produit_id', $request->id)->delete();
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
