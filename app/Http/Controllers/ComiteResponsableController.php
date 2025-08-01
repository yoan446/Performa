<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\User;
use Illuminate\Http\Request;

class ComiteResponsableController extends Controller
{
    /**
     * Liste des responsables liés à un comité
     */
    public function index($comiteId)
    {
        // Charger avec la relation "responsables"
        $comite = Comite::with('responsables')->findOrFail($comiteId);
        return response()->json($comite->responsables);
    }

    /**
     * Lier plusieurs utilisateurs comme responsables à un comité (vérifie le rôle "comite")
     */
    public function store(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $comite = Comite::findOrFail($comiteId);

        // Synchroniser sans détacher (ajouter sans supprimer les anciens)
        $comite->responsables()->syncWithoutDetaching($request->user_ids);

        return response()->json(['message' => 'Utilisateurs liés au comité avec succès.']);
    }

    /**
     * Met à jour la liste des responsables liés à un comité (remplace tous)
     */
    public function update(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $comite = Comite::findOrFail($comiteId);

        // Synchroniser (remplacer la liste)
        $comite->responsables()->sync($request->user_ids);

        return response()->json(['message' => 'Liste mise à jour avec succès.']);
    }

    /**
     * Retirer un responsable spécifique d’un comité
     */
    public function detach($comiteId, $userId)
    {
        $comite = Comite::findOrFail($comiteId);
        $comite->responsables()->detach($userId);

        return response()->json(['message' => 'Utilisateur retiré du comité.']);
    }

    /**
     * Transférer un groupe de responsables d’un comité à un autre
     */
    public function transfer(Request $request)
    {
        $request->validate([
            'from_comite_id' => 'required|exists:comites,id',
            'to_comite_id' => 'required|exists:comites,id|different:from_comite_id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Vérification des rôles "comite" - attention à ta relation roles() dans User (au pluriel)
        $invalidUsers = User::whereIn('id', $request->user_ids)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('nom_role', 'comite');
            })
            ->pluck('id');

        if ($invalidUsers->isNotEmpty()) {
            return response()->json([
                'message' => 'Certains utilisateurs ne possèdent pas le rôle "comite".',
                'invalid_user_ids' => $invalidUsers
            ], 422);
        }

        $from = Comite::findOrFail($request->from_comite_id);
        $to = Comite::findOrFail($request->to_comite_id);

        $from->responsables()->detach($request->user_ids);
        $to->responsables()->syncWithoutDetaching($request->user_ids);

        return response()->json(['message' => 'Transfert effectué avec succès.']);
    }
}
