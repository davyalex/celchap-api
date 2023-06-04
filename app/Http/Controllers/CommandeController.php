<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commande;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //recuperation des commandes de la boutique connecté du vendeur

        $commande = Commande::with(['user','livraison','produits','boutiques'  ])
        ->whereHas('boutiques',
        fn($q)=>$q->where('boutique_id',Auth::user()->boutique_id))
        ->get();
      
        return response()->json(['commandes'=>$commande] ,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            // 'nombre_produit' => 'required',
            // 'sous_total' => 'required',
            // // 'tarif_livraison' => 'required',
            // 'montant_total' => 'required',
            // 'status' => '',
            // 'user_id' => '',
            // 'boutique_id' => 'required',
            // 'livraison_id' => 'required',
        ]);

        //recuperation du client
        $getClient = $request['client'];
        $client = User::firstOrcreate([
            'fullname' => $getClient['fullname'],
            'indicatif' => $getClient['indicatif'],
            'phone' => $getClient['phone'],
            'email' => $getClient['email'],
            'localisation' => $getClient['localisation'],
            'password' =>Hash::make( $getClient['password']),
        ]);

           //assign-role
           $client->assignRole('client');

        //insertion de la commande
        $getCommande = $request['commande'];
        $code = Str::random(10);
        $commande = Commande::firstOrCreate([
            'code' =>'cm-'.$code,
            'nombre_produit' => $getCommande['nombre_produit'],
            'sous_total' => $getCommande['sous_total'],
            'livraison_id' => $getCommande['livraison_id'],
            'montant_total' => $getCommande['montant_total'],
            'status' => 'attente',
            'user_id' => $client['id'],
            'boutique_id' => Auth::user()->boutique_id,
        ]);

        //insertion des produits dans le pivot commande_produit
        $getProduit = $request['produit'];
       
        foreach ($getProduit as  $value) {
            $commande->produits()->attach($value['id'], [
                'quantite' => $value['quantite'],
                'prix_vendeur' => $value['prix_vendeur'],
                'montant_ajouter' => $value['montant_ajouter'],
                'prix_afficher' => $value['prix_afficher'],
                'total' => $value['total'],
                'boutique_id' => $value['boutique_id'],
            ]);
        }

      
        return response()->json([
            'message' => 'commande reussi'
        ]);
    }

    public function detail(Request $request){

        //recuperer les detail d'une commande

        $commande  = Commande::whereId($request['id'])
        ->with(['user','livraison','produits','boutiques'])->get();

        return response()->json(['commande'=>$commande],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
