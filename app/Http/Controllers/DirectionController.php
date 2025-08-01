<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;

class DirectionController extends Controller
{
    public function index()
    {
        return Direction::all(); 
    }

    // Enregistrer une nouvelle direction dans la base de données
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'chef' => 'nullable|exists:users,id', // chef = id d’un user
            'employee_count' => 'nullable|integer|min:0',
        ]);

        $direction = Direction::create([
            'name' => $validated['name'],
            'chef' => $validated['chef'] ?? null, // id de l’utilisateur (ou null)
            'employee_count' => $validated['employee_count'] ?? 0,
        ]);

        return response()->json([
            'message' => 'Direction créée avec succès.',
            'data' => $direction
        ]);
    }



    //afficher une direction en particulier
    public function show($id)
    {
        $direction = Direction::find($id);

        if (!$direction) {
            return response()->json(['message' => 'Direction not found'], 404);  // Code HTTP 404 si la direction n'existe pas
        }

        return response()->json($direction);
    }

    //mettre à jour les infos d'une direction
  public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'chef' => 'sometimes|nullable|exists:users,id',
            'employee_count' => 'sometimes|nullable|integer|min:0',
        ]);

        $direction = Direction::find($id);

        if (!$direction) {
            return response()->json(['message' => 'Direction not found'], 404);
        }

        $direction->update($validated);

        return response()->json($direction);
    }



    //fonction pour supprimer un direction précise
    public function destroy($id)
    {
        $direction = Direction::find($id);

        if (!$direction) {
            return response()->json(['message' => 'Direction not found'], 404);
        }

        $direction->delete();

        return response()->json(['message' => 'Direction deleted successfully']);
    }
}
