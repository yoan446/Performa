<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    public function index()
    {
        $comites = Comite::all();
        return response()->json($comites);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_comite' => 'required|string|max:255',
            'cycle_id' => 'required|exists:cycles,id',
        ]);

        $comite = Comite::create($request->all());

        return response()->json([
            'message' => 'Comité créé avec succès.',
            'comite' => $comite
        ], 201);
    }

    public function show(Comite $comite)
    {
        return response()->json($comite);
    }

    public function update(Request $request, Comite $comite)
    {
        $request->validate([
            'nom_comite' => 'required|string|max:255',
            'cycle_id' => 'required|exists:cycles,id',
        ]);

        $comite->update($request->all());

        return response()->json([
            'message' => 'Comité mis à jour avec succès.',
            'comite' => $comite
        ]);
    }

    public function destroy(Comite $comite)
    {
        $comite->delete();

        return response()->json([
            'message' => 'Comité supprimé avec succès.'
        ]);
    }
}
