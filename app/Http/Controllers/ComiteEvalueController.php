<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteEvalueController extends Controller
{
    /**
     * Liste des agents évalués liés à un comité
     */
    public function index($comiteId)
    {
        $comite = Comite::findOrFail($comiteId);

        // Charge les agents évalués associés via la relation 'agents'
        $agents = $comite->agents()->get();

        return response()->json([
            'message' => 'Liste des agents évalués récupérée avec succès.',
            'agents' => $agents,
        ]);
    }

    /**
     * Ajoute un ou plusieurs agents évalués à un comité (sans supprimer les autres)
     */
    public function store(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $comite = Comite::findOrFail($comiteId);
        $comite->agents()->syncWithoutDetaching($request->user_ids);

        return response()->json([
            'message' => 'Agents évalués ajoutés au comité avec succès.',
        ]);
    }

    /**
     * Met à jour (remplace complètement) la liste des agents évalués associés à un comité
     */
    public function update(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $comite = Comite::findOrFail($comiteId);
        $comite->agents()->sync($request->user_ids);

        return response()->json([
            'message' => 'Liste des agents évalués mise à jour avec succès.',
        ]);
    }

    /**
     * Supprime un agent évalué spécifique d’un comité
     */
    public function detach($comiteId, $userId)
    {
        $comite = Comite::findOrFail($comiteId);

        // Optionnel : vérifier que l'agent est bien lié avant detach
        if (!$comite->agents()->where('user_id', $userId)->exists()) {
            return response()->json([
                'message' => "L'agent évalué spécifié n'est pas lié à ce comité.",
            ], 404);
        }

        $comite->agents()->detach($userId);

        return response()->json([
            'message' => 'Agent évalué retiré du comité avec succès.',
        ]);
    }
}
