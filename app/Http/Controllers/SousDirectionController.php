<?php

namespace App\Http\Controllers;

use App\Models\SousDirection;
use Illuminate\Http\Request;

class SousDirectionController extends Controller
{
    public function index()
    {
        $sousDirections = SousDirection::with(['chef', 'direction'])->get();
        return response()->json($sousDirections);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'chef_id' => 'nullable|exists:users,id',
            'direction_id' => 'required|exists:directions,id',
            'nombre_employes' => 'nullable|integer|min:0',
        ]);

        $sousDirection = SousDirection::create($validated);
        return response()->json($sousDirection, 201);
    }

    public function show($id)
    {
        $sousDirection = SousDirection::with(['chef', 'direction'])->findOrFail($id);
        return response()->json($sousDirection);
    }

    public function update(Request $request, $id)
    {
        $sousDirection = SousDirection::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'chef_id' => 'nullable|exists:users,id',
            'direction_id' => 'sometimes|exists:directions,id',
            'nombre_employes' => 'nullable|integer|min:0',
        ]);

        $sousDirection->update($validated);
        return response()->json($sousDirection);
    }

    public function destroy($id)
    {
        $sousDirection = SousDirection::findOrFail($id);
        $sousDirection->delete();
        return response()->json(['message' => 'Deleted successfully.']);
    }
}
