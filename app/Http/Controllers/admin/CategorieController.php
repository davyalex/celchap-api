<?php

namespace App\Http\Controllers\admin;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorie = Categorie::with(['media','sous_categories','produits'])->get();
        // dd($categorie);
        return view('admin.pages.categorie.index',compact('categorie'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        Alert::toast('Operation réussi','success');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

        $categorie = tap(Categorie::find($request->id))->update([
            'name' => $request->name,
        ]);

        if ($request->hasFile('image')) {
            $categorie->clearMediaCollection('image');
            $categorie->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        Alert::toast('Operation réussi','success');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $delete = Categorie::find($request->id)->delete();
        $delete = DB::table('media')->where('model_id', $request->id)->delete();
        Alert::toast('Operation réussi','success');
        return back();    }
}
