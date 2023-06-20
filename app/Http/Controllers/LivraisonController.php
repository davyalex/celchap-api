<?php

namespace App\Http\Controllers;

use App\Models\Livraison;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLivraisonRequest;
use App\Http\Requests\UpdateLivraisonRequest;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $livraison = Livraison::get();
        return response()->json(['livraison' => $livraison], 200);
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
            'lieu' => 'required',
            'tarif' => 'required',

        ]);
        $code = Str::random(5);
        $livraison = Livraison::firstOrCreate([
            'code' => 'LIV' . $code,
            'lieu' => $request->lieu,
            'tarif' => $request->tarif,
        ]);
        return response()->json(['livraison' => $livraison], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Livraison $livraison)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livraison $livraison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        $livraison = tap(Livraison::find($request->id))->update([
            'lieu' => $request->lieu,
            'tarif' => $request->tarif,
        ]);
        return response()->json(['livraison' => $livraison], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Livraison::find($request->id)->delete();

        return response()->json(['message' => 'Livraison supprimée'], 200);
    }
}
