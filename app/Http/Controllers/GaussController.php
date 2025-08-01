<?php

namespace App\Http\Controllers;

use App\Models\Gauss;
use Illuminate\Http\Request;

class GaussController extends Controller
{
    // Liste toutes les lignes gauss
    public function index()
    {
        $gauss = Gauss::with(['comite', 'appreciation'])->get();
        return response()->json($gauss);
    }

    // Affiche une ligne gauss spécifique
    public function show($id)
    {
        $gauss = Gauss::with(['comite', 'appreciation'])->findOrFail($id);
        return response()->json($gauss);
    }

    // Crée une nouvelle ligne gauss
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comite_id' => 'required|exists:comites,id',
            'appreciation_id' => 'required|exists:appreciations,id',
            'quota_max' => 'required|numeric|min:0|max:100',
        ]);

        $gauss = Gauss::create($validated);

        return response()->json([
            'message' => 'Quota Gauss ajouté avec succès',
            'data' => $gauss
        ], 201);
    }

    // Met à jour une ligne gauss
    public function update(Request $request, $id)
    {
        $gauss = Gauss::findOrFail($id);

        $validated = $request->validate([
            'comite_id' => 'sometimes|required|exists:comites,id',
            'appreciation_id' => 'sometimes|required|exists:appreciations,id',
            'quota_max' => 'sometimes|required|numeric|min:0|max:100',
        ]);

        $gauss->update($validated);

        return response()->json([
            'message' => 'Quota Gauss mis à jour avec succès',
            'data' => $gauss
        ]);
    }

    // Supprime une ligne gauss
    public function destroy($id)
    {
        $gauss = Gauss::findOrFail($id);
        $gauss->delete();

        return response()->json([
            'message' => 'Quota Gauss supprimé avec succès'
        ], 204);
    }
}
