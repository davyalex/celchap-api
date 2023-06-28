<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SousCategorie;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class SousCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sous_categorie = SousCategorie::with(['media', 'categorie'])->get();
        return view('admin.pages.categorie.index', compact('sous_categorie'));
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

        Alert::toast('Operation réussi', 'success');
        return back();
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

        Alert::toast('Operation réussi', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $delete = SousCategorie::find($request->id)->delete();
        $delete = DB::table('media')->where('model_id', $request->id)->delete();
        Alert::toast('Operation réussi', 'success');
        return back();
    }
}
