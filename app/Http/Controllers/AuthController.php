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

        // Tente d'authentifier avec JWT guard 'api'
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Identifiants incorrects'], 401);
        }

        // Retourne le token JWT avec ses infos
        return $this->respondWithToken($token);
    }

    // Retourne les infos de l'utilisateur connecté
    public function me()
    {
        return response()->json(Auth::guard('api')->user());
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
