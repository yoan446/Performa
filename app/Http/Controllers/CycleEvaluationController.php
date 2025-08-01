<?php

namespace App\Http\Controllers;

use App\Models\CycleEvaluation;
use Illuminate\Http\Request;

class CycleEvaluationController extends Controller
{
    // Affiche la liste des cycles
    public function index()
    {
        $cycles = CycleEvaluation::all();
        return response()->json($cycles);
    }

    // Affiche un cycle spécifique
    public function show($id)
    {
        $cycle = CycleEvaluation::findOrFail($id);
        return response()->json($cycle);
    }

    // Crée un nouveau cycle
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'notation_max' => 'required|integer|min:0',
        ]);

        $cycle = CycleEvaluation::create($validated);

        return response()->json($cycle, 201);
    }

    // Met à jour un cycle existant
    public function update(Request $request, $id)
    {
        $cycle = CycleEvaluation::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date|after_or_equal:date_debut',
            'notation_max' => 'sometimes|required|integer|min:0',
        ]);

        $cycle->update($validated);

        return response()->json($cycle);
    }

    // Supprime un cycle
    public function destroy($id)
    {
        $cycle = CycleEvaluation::findOrFail($id);
        $cycle->delete();

        return response()->json(null, 204);
    }
}

