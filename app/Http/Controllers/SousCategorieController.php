<?php

namespace App\Http\Controllers;

use App\Models\SousCategorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSousCategorieRequest;
use App\Http\Requests\UpdateSousCategorieRequest;

class SousCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sous_categorie = SousCategorie::with(['media','categorie'])->get();
        return response()->json(['sous_categorie' => $sous_categorie], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',

        ]);
        $code = Str::random(5);
        $sous_categorie = SousCategorie::firstOrCreate([
            'code' => $code,
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        if ($request->file('image')) {
            $sous_categorie->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return response()->json(['sous_categorie' => $sous_categorie], 200);
    }


    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $sous_categorie = tap(SousCategorie::find($request->id))->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $sous_categorie->clearMediaCollection('image');
            $sous_categorie->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return response()->json(['sous_categorie' => $sous_categorie], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $delete = SousCategorie::find($request->id)->delete();
        $delete = DB::table('media')->where('model_id', $request->id)->delete();
        return response()->json(['message' => 'sous categorie supprimée'], 200);
    }
}
