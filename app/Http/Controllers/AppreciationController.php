<?php

namespace App\Http\Controllers;

use App\Models\Appreciation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class AppreciationController extends Controller
{
    /** Affiche la liste des appréciations */
    public function index(): Response
    {
        return response(
            Appreciation::all(),
            200
        );
    }

    /** Enregistre une nouvelle appréciation */
    public function store(Request $request): Response
    {
        $validated = $request->validate([
            'code'        => ['required', 'string', 'max:5', 'unique:appreciations,code'],
            'description' => ['required', 'string', 'max:255'],
            'valeur_min'  => ['required', 'numeric', 'lte:valeur_max'],
            'valeur_max'  => ['required', 'numeric', 'gte:valeur_min'],
        ]);

        $appreciation = Appreciation::create($validated);

        return response($appreciation, 201);
    }

    /** Affiche une appréciation précise */
    public function show(Appreciation $appreciation): Response
    {
        return response($appreciation, 200);
    }

    /** Met à jour une appréciation */
    public function update(Request $request, Appreciation $appreciation): Response
    {
        $validated = $request->validate([
            'code'        => ['sometimes', 'string', 'max:5', Rule::unique('appreciations')->ignore($appreciation->id)],
            'description' => ['sometimes', 'string', 'max:255'],
            'valeur_min'  => ['required', 'numeric', 'lte:valeur_max'],
            'valeur_max'  => ['required', 'numeric', 'gte:valeur_min'],
        ]);

        $appreciation->update($validated);

        return response($appreciation, 200);
    }

    /** Supprime une appréciation */
    public function destroy(Appreciation $appreciation): Response
    {
        $appreciation->delete();

        return response(null, 204);
    }
}
