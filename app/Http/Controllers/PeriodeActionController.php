<?php

namespace App\Http\Controllers;

use App\Models\PeriodeAction;
use App\Models\CycleEvaluation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PeriodeActionController extends Controller
{
    /**
     * Liste toutes les périodes.
     */
    public function index(): JsonResponse
    {
        $periodes = PeriodeAction::with(['action', 'cycle'])->get();

        return response()->json([
            'message' => 'Liste des périodes récupérée avec succès.',
            'data' => $periodes
        ]);
    }

    /**
     * Affiche une période spécifique.
     */
    public function show($id): JsonResponse
    {
        $periode = PeriodeAction::with(['action', 'cycle'])->findOrFail($id);

        return response()->json([
            'message' => 'Période récupérée avec succès.',
            'data' => $periode
        ]);
    }

    /**
     * Crée une nouvelle période.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cycle_id' => 'required|exists:cycles_evaluation,id_cycle',
            'id_action' => 'required|exists:actions,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $cycle = CycleEvaluation::findOrFail($validated['cycle_id']);

        if ($validated['date_debut'] < $cycle->date_debut || $validated['date_fin'] > $cycle->date_fin) {
            return response()->json([
                'message' => 'La période doit être comprise entre la date de début et la date de fin du cycle.'
            ], 422);
        }

        $overlap = PeriodeAction::where('cycle_id', $validated['cycle_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('date_debut', [$validated['date_debut'], $validated['date_fin']])
                      ->orWhereBetween('date_fin', [$validated['date_debut'], $validated['date_fin']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('date_debut', '<=', $validated['date_debut'])
                            ->where('date_fin', '>=', $validated['date_fin']);
                      });
            })->exists();

        if ($overlap) {
            return response()->json([
                'message' => 'Cette période chevauche une autre période existante du même cycle.'
            ], 422);
        }

        $periode = PeriodeAction::create($validated);

        return response()->json([
            'message' => 'Période créée avec succès.',
            'data' => $periode
        ], 201);
    }

    /**
     * Met à jour une période existante.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $periode = PeriodeAction::findOrFail($id);

        $validated = $request->validate([
            'cycle_id' => 'sometimes|required|exists:cycles_evaluation,id_cycle',
            'id_action' => 'sometimes|required|exists:actions,id',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date|after_or_equal:date_debut',
        ]);

        $cycleId = $validated['cycle_id'] ?? $periode->cycle_id;
        $dateDebut = $validated['date_debut'] ?? $periode->date_debut;
        $dateFin = $validated['date_fin'] ?? $periode->date_fin;

        $cycle = CycleEvaluation::findOrFail($cycleId);

        if ($dateDebut < $cycle->date_debut || $dateFin > $cycle->date_fin) {
            return response()->json([
                'message' => 'La période doit être comprise entre la date de début et la date de fin du cycle.'
            ], 422);
        }

        $overlap = PeriodeAction::where('cycle_id', $cycleId)
            ->where('id', '<>', $id)
            ->where(function ($query) use ($dateDebut, $dateFin) {
                $query->whereBetween('date_debut', [$dateDebut, $dateFin])
                      ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                      ->orWhere(function($q) use ($dateDebut, $dateFin) {
                          $q->where('date_debut', '<=', $dateDebut)
                            ->where('date_fin', '>=', $dateFin);
                      });
            })->exists();

        if ($overlap) {
            return response()->json([
                'message' => 'Cette période chevauche une autre période existante du même cycle.'
            ], 422);
        }

        $periode->update($validated);

        return response()->json([
            'message' => 'Période mise à jour avec succès.',
            'data' => $periode
        ]);
    }

    /**
     * Supprime une période.
     */
    public function destroy($id): JsonResponse
    {
        $periode = PeriodeAction::findOrFail($id);
        $periode->delete();

        return response()->json([
            'message' => 'Période supprimée avec succès.'
        ]);
    }
}
