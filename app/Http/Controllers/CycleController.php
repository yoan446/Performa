<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cycle;

class CycleController extends Controller
{
    // Liste tous les cycles
    public function index()
    {
        return Cycle::all();
    }

    // Crée un nouveau cycle
    public function store(Request $request)
    {
        $request->validate([
            'nom_cycle'         => 'required|string|max:255',
            'debut_cycle'       => 'required|date',
            'fin_cycle'         => 'required|date|after_or_equal:debut_cycle',

            'debut_fixation'    => 'required|date',
            'fin_fixation'      => 'required|date|after_or_equal:debut_fixation',
            'debut_auto_eval'   => 'required|date|after_or_equal:fin_fixation',
            'fin_auto_eval'     => 'required|date|after_or_equal:debut_auto_eval',
            'debut_eval_manager'=> 'required|date|after_or_equal:fin_auto_eval',
            'fin_eval_manager'  => 'required|date|after_or_equal:debut_eval_manager',
            'debut_eval_comite' => 'required|date|after_or_equal:fin_eval_manager',
            'fin_eval_comite'   => 'required|date|after_or_equal:debut_eval_comite',
        ]);

        $cycle = Cycle::create($request->all());

        return response()->json([
            'message' => 'Cycle créé avec succès',
            'data' => $cycle
        ]);
    }

    // Affiche un cycle
    public function show($id)
    {
        $cycle = Cycle::findOrFail($id);
        return response()->json($cycle);
    }

    // Met à jour un cycle
    public function update(Request $request, $id)
    {
        $cycle = Cycle::findOrFail($id);

        $request->validate([
            'nom_cycle'         => 'sometimes|string|max:255',
            'debut_cycle'       => 'sometimes|date',
            'fin_cycle'         => 'sometimes|date|after_or_equal:debut_cycle',

            'debut_fixation'    => 'sometimes|date',
            'fin_fixation'      => 'sometimes|date|after_or_equal:debut_fixation',
            'debut_auto_eval'   => 'sometimes|date|after_or_equal:fin_fixation',
            'fin_auto_eval'     => 'sometimes|date|after_or_equal:debut_auto_eval',
            'debut_eval_manager'=> 'sometimes|date|after_or_equal:fin_auto_eval',
            'fin_eval_manager'  => 'sometimes|date|after_or_equal:debut_eval_manager',
            'debut_eval_comite' => 'sometimes|date|after_or_equal:fin_eval_manager',
            'fin_eval_comite'   => 'sometimes|date|after_or_equal:debut_eval_comite',
        ]);

        $cycle->update($request->all());

        return response()->json([
            'message' => 'Cycle mis à jour avec succès',
            'data' => $cycle
        ]);
    }

    // Supprime un cycle
    public function destroy($id)
    {
        $cycle = Cycle::findOrFail($id);
        $cycle->delete();

        return response()->json([
            'message' => 'Cycle supprimé avec succès'
        ]);
    }
}
