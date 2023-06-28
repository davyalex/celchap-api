<?php

namespace App\Http\Controllers\admin;

use App\Models\Livraison;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
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
        return view('admin.pages.livraison.index',compact('livraison'));
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
            // 'code' => 'LIV' . $code,
            'lieu' => $request->lieu,
            'tarif' => $request->tarif,
        ]);
        Alert::toast('Operation réussi','success');
        return back();    }

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
            'tarif' => 'required',
            'lieu' => 'required',

        ]);

        $livraison = tap(Livraison::find($request->id))->update([
            'lieu' => $request->lieu,
            'tarif' => $request->tarif,
        ]);
        Alert::toast('Operation réussi','success');
        return back();    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Livraison::find($request->id)->delete();

        Alert::toast('Operation réussi','success');
        return back();    }
}
