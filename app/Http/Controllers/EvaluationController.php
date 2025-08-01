<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use App\Models\{Evaluation, Appreciation, Cycle, Commentaire, Fichier, User};
use Carbon\Carbon;
class EvaluationController extends Controller
{
    //que mettre à ce niveau?????????????????????????????????????????
    // Liste toutes les évaluations
    public function index()
    {
        $evaluations = Evaluation::all();
        return response()->json($evaluations);
    }


    // Mettre à jour une évaluation
    public function update(Request $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);

        $validated = $request->validate([
            'note_auto_eval' => 'nullable|string',
            'note_manager' => 'nullable|string',
            'note_comite' => 'nullable|string',
        ]);

        $evaluation->update($validated);

        return response()->json(['message' => 'Évaluation mise à jour avec succès.', 'evaluation' => $evaluation]);
    }

    // Supprimer une évaluation
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return response()->json(['message' => 'Évaluation supprimée avec succès.']);
    }


    //fonction évaluer pour un agent
    public function store_agent(Request $request)
    {
        $now = Carbon::now()->startOfDay();

        // 1. Validation des champs
        $validated = $request->validate([
            'objectif_id' => 'required|exists:objectifs_users,id',
            'users_id' => 'required|exists:users,id',
            'note' => 'required',
            'commentaire' => 'required|string|max:1000',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,zip,png,jpg,jpeg|max:2048',
        ]);

        $user = User::find($validated['users_id']);

        // 2. Cycle actif
        $cycle = Cycle::where('debut_auto_eval', '<=', $now)
                    ->where('fin_eval_comite', '>=', $now)
                    ->first();

        if (!$cycle) {
            return response()->json(['message' => 'Ce cycle n\'est pas actif.'], 403);
        }

        // 3. Phase active : auto
        if (!$now->between($cycle->debut_auto_eval, $cycle->fin_auto_eval)) {
            return response()->json(['message' => 'Cette phase n\'est pas encore active.'], 403);
        }

        // 4. Vérification du rôle
        $roles = $user->roles->pluck('nom_role')->map(fn($r) => strtolower($r))->toArray();
        if (!in_array('agent', $roles)) {
            return response()->json(['message' => 'Rôle invalide pour cette phase.'], 403);
        }

        // 5. Recherche de la note
        $noteId = is_numeric($validated['note']) ? (int) $validated['note'] : Appreciation::where('code', $validated['note'])->value('id');
        if (!$noteId) {
            return response()->json(['message' => 'Note invalide.'], 422);
        }

        // 6. Recherche ou création de l'évaluation liée à l'objectif et au cycle
        $evaluation = Evaluation::firstOrNew([
            'objectif_id' => $validated['objectif_id'],
            'cycle_id' => $cycle->id,
        ]);

        // 7. Mise à jour des données pour la phase "auto"
        $evaluation->note_auto_id = $noteId;
        $evaluation->agent_id = $user->id;
        $evaluation->save();

        // 8. Création du commentaire
        Commentaire::create([
            'evaluation_id' => $evaluation->id,
            'auteur_id' => $user->id,
            'message' => $validated['commentaire'],
            'role_auteur' => 'agent',
        ]);

        // 9. Gestion du fichier joint
        if ($request->hasFile('fichier')) {
            $chemin = $request->file('fichier')->store('evaluations', 'public');
            Fichier::create([
                'evaluation_id' => $evaluation->id,
                'user_id' => $user->id,
                'nom' => $request->file('fichier')->getClientOriginalName(),
                'chemin' => $chemin,
            ]);
        }

        // 10. Réponse JSON
        return response()->json([
            'message' => 'Évaluation enregistrée avec succès.',
            'evaluation' => $evaluation,
        ], 201);
    }


    //fonction évaluer pour les manager
    public function store_manager(Request $request)
    {
        $now = Carbon::now()->startOfDay();

        // 1. Validation des champs
        $validated = $request->validate([
            'objectif_id' => 'required|exists:objectifs_users,id',
            'users_id_manager' => 'required|exists:users,id',
            'note' => 'required',
            'commentaire' => 'required|string|max:1000',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,zip,png,jpg,jpeg|max:2048',
        ]);

        $user = User::find($validated['users_id_manager']);

        // 2. Cycle actif
        $cycle = Cycle::where('debut_auto_eval', '<=', $now)
                    ->where('fin_eval_comite', '>=', $now)
                    ->first();

        if (!$cycle) {
            return response()->json(['message' => 'Ce cycle n\'est pas actif.'], 403);
        }

        // 3. Phase active : manager
        if (!$now->between($cycle->debut_eval_manager, $cycle->fin_eval_manager)) {
            return response()->json(['message' => 'Cette phase n\'est pas encore active.'], 403);
        }

        // 4. Vérification du rôle
        $roles = $user->roles->pluck('nom_role')->map(fn($r) => strtolower($r))->toArray();
        if (!in_array('manager', $roles)) {
            return response()->json(['message' => 'Rôle invalide pour cette phase.'], 403);
        }

        // 5. Recherche de la note
        $noteId = is_numeric($validated['note']) ? (int) $validated['note'] : Appreciation::where('code', $validated['note'])->value('id');
        if (!$noteId) {
            return response()->json(['message' => 'Note invalide.'], 422);
        }

        // 6. Recherche ou création de l'évaluation liée à l'objectif et au cycle
        $evaluation = Evaluation::firstOrNew([
            'objectif_id' => $validated['objectif_id'],
            'cycle_id' => $cycle->id,
        ]);

        // 7. Mise à jour des données pour la phase "manager"
        $evaluation->note_manager_id = $noteId;
        $evaluation->manager_id = $user->id;
        $evaluation->save();

        // 8. Création du commentaire
        Commentaire::create([
            'evaluation_id' => $evaluation->id,
            'auteur_id' => $user->id,
            'message' => $validated['commentaire'],
            'role_auteur' => 'manager',
        ]);

        // 9. Gestion du fichier joint
        if ($request->hasFile('fichier')) {
            $chemin = $request->file('fichier')->store('evaluations', 'public');
            Fichier::create([
                'evaluation_id' => $evaluation->id,
                'user_id' => $user->id,
                'nom' => $request->file('fichier')->getClientOriginalName(),
                'chemin' => $chemin,
            ]);
        }

        // 10. Réponse JSON
        return response()->json([
            'message' => 'Évaluation enregistrée avec succès.',
            'evaluation' => $evaluation,
        ], 201);
    }

    // Fonction évaluer pour le comité
    public function store_comite(Request $request)
    {
        $now = Carbon::now()->startOfDay();

        // 1. Validation des champs
        $validated = $request->validate([
            'objectif_id' => 'required|exists:objectifs_users,id',
            'users_id_comite' => 'required|exists:users,id',
            'note' => 'required',
            'commentaire' => 'required|string|max:1000',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,zip,png,jpg,jpeg|max:2048',
        ]);

        $user = User::find($validated['users_id_comite']);

        // 2. Vérification de l'existence du cycle actif pour le comité
        $cycle = Cycle::where('debut_auto_eval', '<=', $now)
                    ->where('fin_eval_comite', '>=', $now)
                    ->first();

        if (!$cycle) {
            return response()->json(['message' => 'Ce cycle n\'est pas cycle actif.'], 403);
        }

        // 3. Vérification de la phase active : comite
        if (!$now->between($cycle->debut_eval_comite, $cycle->fin_eval_comite)) {
            return response()->json(['message' => 'Cette phase n\'est pas encore active.'], 403);
        }

        // 4. Vérification du rôle de l'utilisateur (doit être membre du comité)
        $roles = $user->roles->pluck('nom_role')->map(fn($r) => strtolower($r))->toArray();
        if (!in_array('comite', $roles)) {
            return response()->json(['message' => 'Rôle invalide pour cette phase.'], 403);
        }

        // 5. Recherche de la note : soit par ID numérique, soit par code
        $noteId = is_numeric($validated['note']) ? (int) $validated['note'] : Appreciation::where('code', $validated['note'])->value('id');
        if (!$noteId) {
            return response()->json(['message' => 'Note invalide.'], 422);
        }

        // 6. Recherche ou création de l'évaluation liée à l'objectif et au cycle
        $evaluation = Evaluation::firstOrNew([
            'objectif_id' => $validated['objectif_id'],
            'cycle_id' => $cycle->id,
        ]);

        // 7. Mise à jour des données pour la phase "comite"
        $evaluation->note_comite_id = $noteId;
        $evaluation->comite_id = $user->id;
        $evaluation->save();

        // 8. Création du commentaire associé à l'évaluation
        Commentaire::create([
            'evaluation_id' => $evaluation->id,
            'auteur_id' => $user->id,
            'message' => $validated['commentaire'],
            'role_auteur' => 'comite',
        ]);

        // 9. Gestion du fichier joint (optionnel)
        if ($request->hasFile('fichier')) {
            $chemin = $request->file('fichier')->store('evaluations', 'public');
            Fichier::create([
                'evaluation_id' => $evaluation->id,
                'user_id' => $user->id,
                'nom' => $request->file('fichier')->getClientOriginalName(),
                'chemin' => $chemin,
            ]);
        }

        // 10. Réponse JSON avec l'évaluation sauvegardée
        return response()->json([
            'message' => 'Évaluation enregistrée avec succès.',
            'evaluation' => $evaluation,
        ], 201);
    }
}