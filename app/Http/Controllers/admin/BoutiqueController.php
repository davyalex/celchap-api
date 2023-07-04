<?php

namespace App\Http\Controllers\admin;

use App\Models\Boutique;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoutiqueController extends Controller
{
    //

    public function index(){
        $boutique = Boutique::with(['media', 'categorie', 'produits', 'commandes', 'user'])
        ->orderBy('name')->get();
        return view('admin.pages.boutique.index',compact('boutique'));
    }

    public function detail($id){
        $boutique = Boutique::with(['media', 'categorie', 'produits', 'commandes', 'user'])
        ->whereId($id)->first();
        return view('admin.pages.boutique.detail',compact('boutique'));
    }
}
