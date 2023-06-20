<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Boutique;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //liste des boutiques
    public function boutique()
    {
        $boutique = Boutique::with(['media', 'categorie', 'produits', 'commandes', 'user'])->get();
        return response()->json([
            'boutique' => $boutique,
        ], 200);
    }

    //liste des users  avec parametre query "role"
    public function user()
    {
        $role = request('role');
        $user = User::with([
            'boutiques', 'roles'
        ])
            ->when(
                $role,
                fn ($q) => $q->whereHas(
                    'roles',
                    fn ($q) => $q->whereName($role)
                )
            )
            ->get();

        return response()->json([
            'user' => $user,
        ], 200);
    }

   
}
