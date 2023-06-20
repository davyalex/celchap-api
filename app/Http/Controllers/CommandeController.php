<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $commande = Commande::with(['user', 'livraison', 'produit', 'boutiques'])
            ->whereHas(
                'boutiques',
                fn ($q) => $q->where('boutique_id', Auth::user()->boutique_id)
            )
            ->get();

        return response()->json(['commandes' => $commande], 200);
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
        // $getClient = $request['client'];
        // $client = User::firstOrcreate([
        //     'fullname' => $getClient['fullname'],
        //     'indicatif' => $getClient['indicatif'],
        //     'phone' => $getClient['phone'],
        //     'email' => $getClient['email'],
        //     'localisation' => $getClient['localisation'],
        //     'password' =>Hash::make( $getClient['password']),
        // ]);

        //    //assign-role
        //    $client->assignRole('client');


        //insertion de la commande
        // $getCommande = $request['commande'];


        // $produit = Produit::whereId($request['produit_id'])->first();
        $livraison = Livraison::whereId($request['livraison_id'])->first();
        $sous_total = $request['quantite'] * $request['prix'];
        $montant_total = $sous_total * $livraison['tarif'];


        $code = Str::random(10);
        $commande = Commande::firstOrCreate([
            'code' => 'cm-' . $code,
            'quantite' => $request['quantite'],
            'sous_total' => $sous_total,
            'livraison_id' => $request['livraison_id'],
            'montant_total' => $montant_total,
            'status' => 'attente',
            'produit_id' => $request['produit_id'],
            'user_id' => Auth::user()->id,
            'boutique_id' => Auth::user()->boutique_id,
        ]);

        return response()->json([
            'message' => 'commande reussi'
        ]);

        //insertion des produits dans le pivot commande_produit
        // $getProduit = $request['produit'];

        // foreach ($getProduit as  $value) {
        // $commande->produits()->attach($value['id'], [
        //     'quantite' => $request['quantite'],
        //     'produit_id' => $request['produit_id'],
        //     'prix_vendeur' => $produit['prix_vendeur'],
        //     'montant_ajouter' => $value['montant_ajouter'],
        //     'prix_afficher' => $value['prix_afficher'],
        //     'total' => $value['total'],
        //     'boutique_id' => $value['boutique_id'],
        // ]);
        // }


    }

    public function detail(Request $request)
    {

        //recuperer les detail d'une commande
        $commandeId = request('id');
        $commande  = Commande::whereCode($commandeId)
            ->with(['user', 'livraison', 'produit', 'boutiques'])->get();

        return response()->json(['commande' => $commande], 200);
    }

    public function commande_user()
    {
        $commande  = Commande::where('user_id', Auth::user()->id)
            ->with(['user', 'livraison', 'produit', 'boutiques'])->get();

        return response()->json(['commande' => $commande], 200);
    }
}
