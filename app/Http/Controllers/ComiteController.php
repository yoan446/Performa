<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
   public function index()
    {
        $comites = Comite::with('cycle')->get();
        return response()->json($comites);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom_comite' => 'required|string|max:255',
            'cycle_id' => 'required|exists:cycles_evaluation,id_cycle',
        ]);

        $comite = Comite::create($request->all());

        return response()->json([
            'message' => 'Comité créé avec succès.',
            'comite' => $comite
        ], 201);
    }

   public function show($id)
    {
        $comite =  Comite::with('cycle')->find($id);

        if (!$comite) {
            return response()->json(['message' => 'Comité non trouvé'], 404);
        }

        return response()->json([
            'message' => 'Comité récupéré avec succès.',
            'data' => $comite
        ]);
    }


    public function update(Request $request, $id)
    {
        // Récupérer le comité ou renvoyer une 404 si introuvable
        $comite = Comite::findOrFail($id);

        $validated = $request->validate([
            'nom_comite' => 'required|string|max:255',
            'cycle_id' => 'required|exists:cycles_evaluation,id_cycle',
        ]);

        // Mise à jour uniquement avec les données validées
        $comite->update($validated);

        return response()->json([
            'message' => 'Comité mis à jour avec succès.',
            'comite' => $comite
        ]);
    }


    public function destroy($id)
    {
        $comite = Comite::find($id);

        if (!$comite) {
            return response()->json([
                'message' => 'Comité non trouvé.'
            ], 404);
        }

        $comite->delete();

        return response()->json([
            'message' => 'Comité supprimé avec succès.'
        ]);
    }
}
