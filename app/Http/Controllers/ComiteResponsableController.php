<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\User;
use Illuminate\Http\Request;

class ComiteResponsableController extends Controller
{
    /**
     * Lister tous les responsables d'un comité
     */
    public function index($comiteId)
    {
        try {
             $comite = Comite::findOrFail($comiteId);
            // Charger les responsables filtrés par rôle 'comite'
            $responsables = $comite->responsables()->whereHas('roles', function($query) {
                $query->where('nom_role', 'comite');
            })->get();

            return response()->json([
                'message' => 'Liste des responsables récupérée avec succès.',
                'responsables' => $responsables,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "Comité avec ID $comiteId non trouvé."], 404);
        }
       
    }

    /**
     * Ajouter un ou plusieurs responsables à un comité (sans supprimer les anciens)
     */
    public function store(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Vérifier que tous les utilisateurs ont le rôle 'comite'
        $invalidUsers = User::whereIn('id', $request->user_ids)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('nom_role', 'comite');
            })->pluck('id');

        if ($invalidUsers->isNotEmpty()) {
            return response()->json([
                'message' => "Les utilisateurs suivants n'ont pas le rôle 'comite' :",
                'invalid_user_ids' => $invalidUsers,
            ], 422);
        }

        $comite = Comite::findOrFail($comiteId);

        // Ajouter sans détacher les anciens
        $comite->responsables()->syncWithoutDetaching($request->user_ids);

        return response()->json([
            'message' => 'Responsables ajoutés avec succès au comité.',
        ]);
    }

    /**
     * Mettre à jour la liste des responsables d’un comité (remplacer complètement)
     */
    public function update(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $invalidUsers = User::whereIn('id', $request->user_ids)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('nom_role', 'comite');
            })->pluck('id');

        if ($invalidUsers->isNotEmpty()) {
            return response()->json([
                'message' => "Les utilisateurs suivants n'ont pas le rôle 'comite' :",
                'invalid_user_ids' => $invalidUsers,
            ], 422);
        }

        $comite = Comite::findOrFail($comiteId);

        // Remplacer la liste complète
        $comite->responsables()->sync($request->user_ids);

        return response()->json([
            'message' => 'Liste des responsables mise à jour avec succès.',
        ]);
    }

    /**
     * Supprimer un responsable spécifique d’un comité
     */
    public function detach($comiteId, $userId)
    {
        $comite = Comite::findOrFail($comiteId);

        // Vérifier que l'utilisateur a le rôle 'comite'
        $user = User::findOrFail($userId);
        if (!$user->roles()->where('nom_role', 'comite')->exists()) {
            return response()->json([
                'message' => "L'utilisateur spécifié n'a pas le rôle 'comite'."
            ], 422);
        }

        // Détacher l'utilisateur
        $comite->responsables()->detach($userId);

        return response()->json([
            'message' => 'Responsable retiré du comité avec succès.',
        ]);
    }
}
