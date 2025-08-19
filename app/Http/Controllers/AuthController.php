<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Connexion et génération du token JWT
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Authentification via JWT
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Identifiants incorrects'], 401);
        }

        // Récupérer l'utilisateur avec ses rôles
        $user = Auth::guard('api')->user();
        unset($user->roles);

        // Extraire juste les noms/slug des rôles dans un tableau
        $roles_users = $user->roles->pluck('nom_role')->toArray();

        // Retourner le token et infos utilisateur
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => $user,
            'roles' => $roles_users
        ]);
    }


    // Retourne les infos de l'utilisateur connecté
    public function me()
    {
        $user = Auth::guard('api')->user();

        // Charger les rôles via la relation
        $user->load('roles');

        return response()->json($user);
    }

    // Déconnexion (invalidation du token JWT)
    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    // Rafraîchir le token JWT
    public function refresh()
    {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }

    // Structure la réponse avec le token et son expiration
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }
}
