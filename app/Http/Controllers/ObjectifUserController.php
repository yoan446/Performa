<?php

namespace App\Http\Controllers;

use App\Models\Objectifs_user;
use App\Models\User;
use App\Models\CycleEvaluation;
use App\Models\Metric;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ObjectifCreeMail;
use App\Models\Commentaire;

class ObjectifUserController extends Controller
{
   
    public function index()
    {
        $objectifs = Objectifs_user::with(['manager', 'agent','cycle'])->get();
        return response()->json($objectifs);
    }

    public function statistique($userId)
    {
        $objectives = Objectifs_user::where('agent_id', $userId)
            ->selectRaw('statut_objectif, COUNT(*) as count')
            ->groupBy('statut_objectif')
            ->pluck('count', 'statut_objectif');

        $stats = [
            'Validated' => $objectives->get('Valider', 0),
            'Completed' => $objectives->get('Realiser', 0),
            'Pending'   => $objectives->get('En Attente de Validation', 0),
            'Rejected'  => $objectives->get('Rejeter', 0),
        ];

        return response()->json([
            'message' => "Statistique de l'objectif récupérée avec succès.",
            'data' => $stats
        ]);
    }

    public function dashboard()
    {
        $userId = session('user_id');
        $objectifs = Objectifs_user::where('agent_id', $userId)->get();
        return view('dashboard', compact('objectifs'));
    }

    public function getObjectifsAgentPourManager($user)
    {
        $managerId = $user;
        $objectifs = Objectifs_user::with(['manager', 'agent'])
            ->where('manager_id', $managerId)
            ->get();

        if ($objectifs->isEmpty()) {
            return response()->json([
                'message' => 'Aucun objectif trouvé pour cet agent sous votre responsabilité.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => "Objectifs de l'agent récupérés avec succès.",
            'data' => $objectifs
        ]);
    }

    public function getObjectifsBySpecificAgent($agentId)
    {
        $agent = User::find($agentId);
        if (!$agent) {
            return response()->json(['message' => 'Agent not found'], 404);
        }

        $objectifs = Objectifs_user::with(['manager', 'agent'])
            ->where('agent_id', $agentId)
            ->get();

        return response()->json([
            'message' => "Objectifs de l'agent récupérés avec succès",
            'agent' => $agent->name ?? 'Agent',
            'data' => $objectifs
        ]);
    }

    public function rejeter(Request $request, $agentId, $userid)
    {
        $now = Carbon::now();
        $cycleActif = CycleEvaluation::where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "Vous ne pouvez pas rejeter ces objectifs. Période dépassée ou non ouverte."
            ], 403);
        }

        $request->validate([
            'commentaire' => 'required|string|max:2000',
        ]);

        $objectifs = Objectifs_user::where('agent_id', $agentId)
            ->where('manager_id', $userid)
            ->get();

        if ($objectifs->isEmpty()) {
            return response()->json(['message' => 'Aucun objectif trouvé ou non autorisé.'], 404);
        }

        foreach ($objectifs as $objectif) {
            $objectif->statut_objectif = 'Rejeter';
            $objectif->save();
        }

        Commentaire::create([
            'message' => $request->commentaire,
            'auteur_id' => $userid,
            'role_auteur' => 'Manager',
            'destinataire_id' => $agentId,
            'date_creation' => now(),
        ]);

        return response()->json([
            'message' => "Tous les objectifs de l'agent ont été rejetés avec succès.",
            'data' => $objectifs
        ]);
    }

    public function validerTousObjectifs($agentId)
    {
        $now = Carbon::now();
        $cycleActif = CycleEvaluation::where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "Vous ne pouvez pas valider ces objectifs. Période dépassée ou non ouverte."
            ], 403);
        }

        $objectifs = Objectifs_user::where('agent_id', $agentId)->get();

        if ($objectifs->isEmpty()) {
            return response()->json(['message' => "Aucun objectif trouvé."], 404);
        }

        foreach ($objectifs as $objectif) {
            $objectif->statut_objectif = 'Valider';
            $objectif->save();
        }

        return response()->json([
            'message' => 'Objectifs validés avec succès.',
            'data' => $objectifs
        ]);
    }

    public function show($id)
    {
        $objectif = Objectifs_user::with(['manager', 'agent','cycle'])->find($id);

        if (!$objectif) {
            return response()->json(['message' => 'Objectif not found'], 404);
        }

        return response()->json($objectif);
    }

    public function store(Request $request)
    {
        $now = Carbon::now();
        $cycleActif = CycleEvaluation::where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->first();

        if (!$cycleActif) {
            return response()->json(['message' => "La période de fixation des objectifs n'est pas ouverte."], 403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'metric' => 'required|exists:metrics,id',
            'valeur' => 'required|integer',
            'poids' => 'required|integer',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut_objectif' => 'nullable|exists:statuts,id',
            'manager_id' => 'required|exists:users,id',
            'agent_id' => 'required|exists:users,id',
        ]);

        $objectif = Objectifs_user::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'metric' => $validated['metric'],
            'valeur' => $validated['valeur'],
            'poids' => $validated['poids'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'statut_objectif' => $validated['statut_objectif'] ?? null,
            'manager_id' => $validated['manager_id'],
            'agent_id' => $validated['agent_id'],
            'id_cycle' => $cycleActif->id_cycle,
        ]);

        $objectif->load('agent', 'manager');

        try {
            Mail::to('yoantioma4@gmail.com')->send(new ObjectifCreeMail($objectif));
        } catch (\Exception $e) {
            \Log::error("Erreur envoi mail objectif : " . $e->getMessage());
        }

        return response()->json([
            'message' => 'Objectif créé avec succès',
            'data' => $objectif
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $now = Carbon::now();
        $cycleActif = CycleEvaluation::where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->first();

        if (!$cycleActif) {
            return response()->json(['message' => "La période de fixation des objectifs n'est pas ouverte."], 403);
        }

        $objectif = Objectifs_user::find($id);
        if (!$objectif) {
            return response()->json(['message' => 'Objectif not found'], 404);
        }

        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'metric' => 'nullable|exists:metrics,id',
            'valeur' => 'nullable|integer',
            'poids' => 'nullable|integer',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'statut_objectif' => 'nullable|exists:statuts,id',
            'manager_id' => 'nullable|exists:users,id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        $objectif->update(array_filter($validated));

        return response()->json($objectif);
    }

    public function destroy($id)
    {
        $now = Carbon::now();
        $cycleActif = CycleEvaluation::where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->first();

        if (!$cycleActif) {
            return response()->json(['message' => "La période de fixation des objectifs n'est pas ouverte."], 403);
        }

        $objectif = Objectifs_user::find($id);
        if (!$objectif) {
            return response()->json(['message' => 'Objectif not found'], 404);
        }

        $objectif->delete();
        return response()->json(['message' => 'Objectif supprimé avec succès']);
    }


    public function getObjectifsByUser($userId)
    {
        $now = Carbon::now();

        $objectifs = Objectifs_user::with(['cycle','statut','agent','manager'])
            ->where('agent_id', $userId)
            ->whereHas('cycle', function($query) use ($now) {
                $query->whereYear('date_debut', '<=', $now->year)
                    ->whereYear('date_fin', '>=', $now->year);
            })
            ->get();

        return response()->json($objectifs);
    }


    //fonction qui renvoie tous les obejctifs enfonction de la période
    public function getObjectifsByCycles($id)
    {
        try {
            // Vérifie si le cycle existe
            $cycle = CycleEvaluation::findOrFail($id);

            // Récupère les objectifs liés à ce cycle
            $objectifs = Objectifs_user::where('id_cycle', $id)->get();

            return response()->json([
                'success' => true,
                'objectifs' => $objectifs,
                'cycle' => $cycle
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cycle introuvable ou erreur serveur',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}