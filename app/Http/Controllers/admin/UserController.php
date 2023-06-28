<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function fournisseur()
    {
        $fournisseur = User::whereHas('roles', fn ($q) => $q->whereName('vendeur'))
            ->with([
                'boutiques', 'commandes', 'roles'
            ])->get();
        return view('admin.pages.fournisseur.index', compact('fournisseur'));
    }
}
