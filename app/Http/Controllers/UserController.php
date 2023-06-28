<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'indicatif' => 'required',
            'phone' => 'required',
            'localisation' => '',
            // 'email' => 'unique:users',
            'password' => 'required',
        ]);

        // $code = Str::random(5);
        $user = User::firstOrcreate([
            // 'code' => $code,
            'fullname' => $request['fullname'],
            'indicatif' => $request['indicatif'],
            'phone' => $request['phone'],
            // 'email' => $request['email'],
            'localisation' => $request['localisation'],
            'password' => Hash::make($request['password']),
        ]);


        if ($user) {
            //image-profil
            if ($request->file('image')) {
                $user->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }
            //assign-role
            $user->assignRole($request['role']);

            //create-token
            $token = $user->createToken('auth_token')->plainTextToken;

            $user = User::with(['roles', 'media'])->whereId($user['id'])->first();

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Operation réussi',
            ], 200);
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        //verify data in

        $data = $request->only('phone', 'password');

        $auth = Auth::attempt($data);

        if (!$auth) {
            return response()->json([
                'message' => 'Contact ou mot de passe incorrect'
            ], 401);
        } else {
            $user = User::with(['roles', 'media'])->wherePhone($request['phone'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            $user = User::with([
                'roles', 'media', 'commandes',
                'boutiques' => function ($q) {
                    $q->with(['categorie', 'commandes'])
                        ->whereId(Auth::user()->boutique_id);
                }
            ])->whereId($user->id)
                ->get();



            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Operation réussi',
            ], 200);
        }
    }


    public function auth()
    {
        $auth = User::with([
            'commandes',
            'boutiques' => function ($q) {
                $q->with(['categorie', 'commandes'])
                    ->whereId(Auth::user()->boutique_id);
            }
        ])
            ->whereId(Auth::user()->id)
            ->get();

        return response()->json([
            'auth' => $auth
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Operation réussi',
        ], 200);
    }
}
