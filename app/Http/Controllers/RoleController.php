<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_role' => 'required|string|unique:roles,nom_role',
            'role_description' => 'nullable|string',
        ]);

        $role = Role::create([
            'nom_role' => $request->nom_role,
            'role_description' => $request->role_description,
        ]);

        return response()->json($role, 201);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'nom_role' => 'required|string|unique:roles,nom_role,' . $role->id,
            'role_description' => 'nullable|string',
        ]);

        $role->update([
            'nom_role' => $request->nom_role,
            'role_description' => $request->role_description,
        ]);

        return response()->json($role);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(null, 204);
    }
}
