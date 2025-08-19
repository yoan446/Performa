<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Liste toutes les actions.
     */
    public function index()
    {
        $actions = Action::all();

        return response()->json([
            'message' => 'Liste des actions récupérée avec succès.',
            'data' => $actions
        ], 200);
    }

    /**
     * Crée une nouvelle action.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url_endpoints' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'nom_module' => 'required|string|max:255',
            'method' => 'required|string|max:255',
        ]);

        $action = Action::create($validated);

        return response()->json([
            'message' => 'Action créée avec succès.',
            'data' => $action
        ], 201);
    }

    /**
     * Affiche les détails d'une action spécifique.
     */
    public function show($id)
    {
        $action = Action::find($id);

        if (!$action) {
            return response()->json([
                'message' => 'Action non trouvée.'
            ], 404);
        }

        return response()->json([
            'message' => 'Action récupérée avec succès.',
            'data' => $action
        ], 200);
    }

    /**
     * Met à jour une action existante.
     */
    public function update(Request $request, $id)
    {
        $action = Action::find($id);

        if (!$action) {
            return response()->json([
                'message' => 'Action non trouvée.'
            ], 404);
        }

        $validated = $request->validate([
            'url_endpoints' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'nom_module' => 'sometimes|required|string|max:255',
        ]);

        $action->update($validated);

        return response()->json([
            'message' => 'Action mise à jour avec succès.',
            'data' => $action
        ], 200);
    }

    /**
     * Supprime une action.
     */
    public function destroy($id)
    {
        $action = Action::find($id);

        if (!$action) {
            return response()->json([
                'message' => 'Action non trouvée.'
            ], 404);
        }

        $action->delete();

        return response()->json([
            'message' => 'Action supprimée avec succès.'
        ], 200);
    }
}
