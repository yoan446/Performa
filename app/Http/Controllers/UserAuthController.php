<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\UserResource;

class UserAuthController extends Controller
{
    /**
     * Connexion de l'utilisateur
     */
    public function login(Request $request)
    {
        // 1. Valider les données entrantes
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Rechercher l'utilisateur
        $user = User::where('email', $credentials['email'])->first();

        // 3. Vérification du mot de passe
        if ($user && Hash::check($credentials['password'], $user->password)) {

            // 4. Récupérer les IDs de rôles depuis la table pivot
            $roleIds = \DB::table('roles_users')
                ->where('user_id', $user->id)
                ->pluck('role_id')
                ->toArray();

            // 5. Récupérer les noms des rôles correspondants
            $roleNames = Role::whereIn('id', $roleIds)
                ->pluck('nom_role')
                ->toArray();

            // 6. Récupérer le nom de la direction
            $directionName = null;
            if ($user->direction_id) {
                $direction = \App\Models\Direction::find($user->direction_id);
                $directionName = $direction ? $direction->name : null;
            }

            // 7. Récupérer le nom du manager
            $managerName = null;
            if ($user->manager_id) {
                $manager = User::find($user->manager_id);
                $managerName = $manager ? $manager->name . ' ' . $manager->secondname : null;
            }

            // 8. Stocker dans la session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_secondname' => $user->secondname,
                'user_email' => $user->email,
                'user_roles' => $roleNames,
                'user_direction' => $directionName,
                'user_manager' => $managerName,
                'user_managerid' => $user->manager_id,
            ]);

            // 9. Rediriger vers dashboard
            return redirect()->route('dashboard');
        }

        // 10. Retourner avec erreur si échec
        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
    }


    /**
     * Informations sur l'utilisateur connecté
     */
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Déconnexion (suppression de tous les tokens de l'utilisateur)
     */
   public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Déconnexion réussie');
    }

}
