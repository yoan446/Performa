<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use App\Models\User;
use Illuminate\Http\Request;

class ComiteEvalueController extends Controller
{
    /**
     * Affiche les agents évalués liés à un comité donné
     */
    public function index($comiteId)
    {
        $comite = Comite::with('evaluatedAgents')->findOrFail($comiteId);
        return response()->json($comite->evaluatedAgents);
    }

    /**
     * Ajoute un ou plusieurs agents évalués à un comité sans supprimer les autres
     */
    public function store(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $comite = Comite::findOrFail($comiteId);
        $comite->evaluatedAgents()->syncWithoutDetaching($request->user_ids);

        return response()->json(['message' => 'Agents évalués ajoutés au comité avec succès.']);
    }

    /**
     * Met à jour (remplace complètement) les agents évalués associés à un comité
     */
    public function update(Request $request, $comiteId)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $comite = Comite::findOrFail($comiteId);
        $comite->evaluatedAgents()->sync($request->user_ids);

        return response()->json(['message' => 'Liste des agents évalués mise à jour avec succès.']);
    }

    /**
     * Supprime un agent évalué spécifique d’un comité
     */
    public function detach($comiteId, $userId)
    {
        $comite = Comite::findOrFail($comiteId);
        $comite->evaluatedAgents()->detach($userId);

        return response()->json(['message' => 'Agent évalué retiré du comité.']);
    }

    /**
     * Transfère des agents évalués d’un comité source vers un comité cible
     */
    public function transfer(Request $request)
    {
        $request->validate([
            'from_comite_id' => 'required|exists:comites,id',
            'to_comite_id' => 'required|exists:comites,id|different:from_comite_id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $from = Comite::findOrFail($request->from_comite_id);
        $to = Comite::findOrFail($request->to_comite_id);

        $from->evaluatedAgents()->detach($request->user_ids);
        $to->evaluatedAgents()->syncWithoutDetaching($request->user_ids);

        return response()->json(['message' => 'Transfert des agents évalués effectué avec succès.']);
    }
}
