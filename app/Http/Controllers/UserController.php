<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direction;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Lister tous les utilisateurs
    public function index()
    {
        $users = User::with(['roles', 'direction'])->get();
        return response()->json($users);
    }

    // Lister tous les utilisateurs
    public function Allusers()
    {
         return User::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'secondname' => 'nullable|string|max:300',
            'email' => 'required|email|unique:users,email',
            'url_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ⬅️ maintenant on attend un fichier image
            'user_job_name' => 'nullable|string|max:100',
            'direction_id' => 'nullable|exists:directions,id',
            'statut_user' => 'nullable|string|max:40',
            'password' => 'required|string|min:6',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // 🔁 Gestion de la photo de profil
        $photoPath = null;
        if ($request->hasFile('url_photo')) {
            $photoPath = $request->file('url_photo')->store('photos', 'public');
        }

        $id_direction = $validated['direction_id'];
        $chef = Direction::where('id', $id_direction)->value('chef');

        $user = User::create([
            'name' => $validated['name'],
            'secondname' => $validated['secondname'] ?? null,
            'email' => $validated['email'],
            'user_job_name' => $validated['user_job_name'] ?? null,
            'direction_id' => $validated['direction_id'] ?? null,
            'statut_user' => $validated['statut_user'] ?? null,
            'manager_id' => $chef ?? null,
            'password' => Hash::make($validated['password']),
            'url_photo' => $photoPath, //Chemin relatif enregistré
        ]);

        $user->roles()->sync($validated['roles']);

        return response()->json([
            'message' => 'Utilisateur créé avec succès.',
            'user' => $user->load('roles'),
        ]);
    }



    // Afficher un utilisateur précis
    public function show($id)
    {
        $user = User::with(['roles'])->find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur inexistant'], 404);
        }

        return response()->json($user);
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validation des champs présents uniquement
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'secondname' => 'sometimes|nullable|string|max:301',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'user_job_name' => 'sometimes|nullable|string|max:255',
            'direction_id' => 'sometimes|nullable|exists:directions,id',
            'statut_user' => 'sometimes|nullable|string|max:255',
            'manager_id' => 'sometimes|nullable|exists:users,id',
            'password' => 'sometimes|nullable|string|min:6',
            'roles' => 'sometimes|nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Mise à jour des champs si présents
        foreach ($validated as $key => $value) {
            if ($key === 'password' && $value !== null) {
                $user->password = Hash::make($value);
            } elseif ($key !== 'roles') {
                $user->$key = $value;
            }
        }

        $user->save();

        // Synchronisation des rôles si fournis
        if (isset($validated['roles'])) {
            $user->roles()->sync($validated['roles']);
        }

        return response()->json($user->load(['roles']));
    }


    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    
    //fonction pour récuperer un tous les agents d'un manager
    public function collaborateursDuManager($managerId)
    {
        // Vérifie si le manager existe
        $manager = User::find($managerId);
        if (!$manager) {
            return response()->json(['message' => 'Manager not found'], 404);
        }

        // Récupère les utilisateurs dont manager_id == $managerId
        $collaborateurs = User::where('manager_id', $managerId)->get();

        return response()->json($collaborateurs);
    }
}
