<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    // Afficher toutes les métriques
    public function index()
    {
        $metrics = Metric::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des métriques récupérée avec succès.',
            'data' => $metrics,
        ]);
    }

    // Créer une nouvelle métrique
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_statut' => 'required|string|max:255',
        ]);

        $metric = Metric::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Métrique créée avec succès.',
            'data' => $metric,
        ], 201);
    }

    // Afficher une métrique spécifique
    public function show($id)
    {
        $metric = Metric::find($id);

        if (!$metric) {
            return response()->json([
                'success' => false,
                'message' => 'Métrique introuvable.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Métrique récupérée avec succès.',
            'data' => $metric,
        ]);
    }

    // Mettre à jour une métrique
    public function update(Request $request, $id)
    {
        $metric = Metric::find($id);

        if (!$metric) {
            return response()->json([
                'success' => false,
                'message' => 'Métrique introuvable.',
            ], 404);
        }

        $validated = $request->validate([
            'nom_statut' => 'required|string|max:255',
        ]);

        $metric->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Métrique mise à jour avec succès.',
            'data' => $metric,
        ]);
    }

    // Supprimer une métrique
    public function destroy($id)
    {
        $metric = Metric::find($id);

        if (!$metric) {
            return response()->json([
                'success' => false,
                'message' => 'Métrique introuvable.',
            ], 404);
        }

        $metric->delete();

        return response()->json([
            'success' => true,
            'message' => 'Métrique supprimée avec succès.',
        ]);
    }
}

