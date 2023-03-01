<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorie = Categorie::with('media')->get();
        return response()->json(['categorie' => $categorie], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
$code = Str::random(5);
        $categorie = Categorie::firstOrCreate([
            'code' => $code,
            'name' => $request->name,
        ]);

        if ($request->file('image')) {
            $categorie->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return response()->json(['categorie' => $categorie], 200);
    }


    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        $categorie = tap(Categorie::find($request->id))->update([
            'name' => $request->name,
        ]);

        if ($request->hasFile('image')) {
            $categorie->clearMediaCollection('image');
            $categorie->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return response()->json(['categorie' => $categorie], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $delete = Categorie::find($request->id)->delete();
        $delete = DB::table('media')->where('model_id', $request->id)->delete();
        return response()->json(['message' => 'Categorie supprimée'], 200);
    }
}
