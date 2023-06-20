<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Boutique;
use App\Models\Abonnement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoutiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $boutique = Boutique::where('user_id', Auth::user()->id)
        ->with(['media','categorie','produits','commandes','user'])->get();
        return response()->json([
            'boutique' => $boutique,
            ], 200);
           
    }


    public function select(Request $request)
    {
        $boutique = Boutique::whereId($request['id'])->first();
        $update = User::find(Auth::user()->id)->update(['boutique_id' => $boutique['id']]);
        return response()->json(['message' => 'Boutique' . ' ' . $boutique['name'] . ' ' . 'selectionnée'], 200);
    }


   
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoutiqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:boutiques',
            'indicatif' => 'required',
            'phone' => 'required',
            'devise' => 'required',
            'description' => '',
            'category' => 'required',
        ]);

        $code = Str::random(5);

        $boutique = Boutique::firstOrCreate([
            'code' => $code,
            'name' => $request->name,
            'devise' => $request->devise,
            'indicatif' => $request->indicatif,
            'phone' => $request->phone,
            'category_id' => $request->category,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->file('image')) {
            $boutique->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        if ($boutique) {
            $update = User::find(Auth::user()->id)->update(['boutique_id' => $boutique['id']]);
            $user = User::whereId(Auth::user()->id)->first();
            $user->assignRole('vendeur');
        }

        return response()->json([
            'message' => 'Boutique crée avec success',
            'boutique' => $boutique
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoutiqueRequest  $request
     * @param  \App\Models\Boutique  $boutique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'indicatif' => 'required',
            'phone' => 'required',
            'devise' => 'required',
            'description' => '',
            'category' => 'required',
        ]);

        $boutique = tap(Boutique::find($request->id))->update([
            'name' => $request->name,
            'devise' => $request->devise,
            'indicatif' => $request->indicatif,
            'phone' => $request->phone,
            'category_id' => $request->category,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->file('image')) {
            $boutique->clearMediaCollection('image');
            $boutique->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return response()->json([
            'message' => 'Boutique modifiée avec success',
            'boutique' => $boutique
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Boutique  $boutique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Boutique::find($request['id'])->delete();

        return response()->json([
            'message' => 'Boutique supprimée avec success',
        ], 200);
    }
}
