<?php

namespace App\Http\Controllers;

use App\Models\Statut;
use Illuminate\Http\Request;

class StatutController extends Controller
{
    // Affiche tous les statuts
    public function index()
    {
        $statuts = Statut::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des statuts récupérée avec succès',
            'data' => $statuts
        ]);
    }

    // Crée un nouveau statut
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'module' => 'required|string|max:255',
        ]);

        $statut = Statut::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Statut créé avec succès',
            'data' => $statut
        ], 201);
    }

    // Affiche un statut précis
    public function show($id)
    {
        $statut = Statut::find($id);

        if (!$statut) {
            return response()->json([
                'success' => false,
                'message' => 'Statut non trouvé'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Statut récupéré avec succès',
            'data' => $statut
        ]);
    }

    // Met à jour un statut
    public function update(Request $request, $id)
    {
        $statut = Statut::find($id);

        if (!$statut) {
            return response()->json([
                'success' => false,
                'message' => 'Statut non trouvé'
            ], 404);
        }

        $validated = $request->validate([
            'libelle' => 'sometimes|required|string|max:255',
            'module' => 'sometimes|required|string|max:255',
        ]);

        $statut->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès',
            'data' => $statut
        ]);
    }

    // Supprime un statut
    public function destroy($id)
    {
        $statut = Statut::find($id);

        if (!$statut) {
            return response()->json([
                'success' => false,
                'message' => 'Statut non trouvé'
            ], 404);
        }

        $statut->delete();

        return response()->json([
            'success' => true,
            'message' => 'Statut supprimé avec succès'
        ]);
    }
}
