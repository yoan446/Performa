<?php
namespace App\Http\Controllers;

use App\Models\Objectifs_user;
use App\Models\User;
use App\Models\Cycle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Mail;
use App\Mail\ObjectifCreeMail;

class ObjectifUserController extends Controller
{
    /**
     * Affiche la liste de tous les objectifs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupère tous les objectifs avec les relations manager et agent
        $objectifs = Objectifs_user::with(['manager', 'agent'])->get();

        return response()->json($objectifs);
    }

    // statut des objectifs en fonction du users
    public function statistique($userId)
    {
       

        $objectives = Objectifs_user::where('agent_id', $userId)
            ->selectRaw('statut_objectif, COUNT(*) as count')
            ->groupBy('statut_objectif')
            ->pluck('count', 'statut_objectif');

        // Crée un tableau avec les statuts connus
        $stats = [
            'Validated' => $objectives->get('Valider', 0),
            'Completed' => $objectives->get('Realiser', 0),
            'Pending'   => $objectives->get('En Attente de Validation', 0),
            'Rejected'  => $objectives->get('Rejeter', 0),
        ];

         return response()->json([
            'message' => 'Statistque de l\'objectif récupérer avec succès.',
            'data' => $stats
        ]);
    }


    /**
     * Récupère les objectifs créés par l'agent (utilisateur actuel).
     *
     * @return \Illuminate\Http\Response
     */
     public function dashboard()
    {
        $userId = session('user_id');

        // 2) Charger les objectifs de cet agent
        $objectifs = Objectifs_user::where('agent_id', $userId)->get();

        // 3) Retourner la vue ‘dashboard’ en lui passant les objectifs
        return view('dashboard', compact('objectifs'));
    }

    
    /**
     * Récupère les objectifs gérés par le manager (utilisateur actuel).
     *
     * @return \Illuminate\Http\Response
     */
    public function getObjectifsAgentPourManager($user)
    {
        //Auth::id()
        $managerId = $user; // ID du manager connecté

        $objectifs = Objectifs_user::with(['manager', 'agent'])
            ->where('manager_id', $managerId)
            ->get();

        // Optionnel : gérer le cas où aucun objectif n'est trouvé
        if ($objectifs->isEmpty()) {
            return response()->json([
                'message' => 'Aucun objectif trouvé pour cet agent sous votre responsabilité.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Objectifs de l’agent récupérés avec succès.',
            'data' => $objectifs
        ]);
    }

    /**
     * Récupère les objectifs par agent_id spécifique (pour les managers).
     *
     * @param  int  $agentId
     * @return \Illuminate\Http\Response
     */
    public function getObjectifsBySpecificAgent($agentId)
    {
        // Vérifier si l'agent existe
        $agent = User::find($agentId);
        if (!$agent) {
            return response()->json(['message' => 'Agent not found'], 404);
        }

        // Récupère tous les objectifs de l'agent spécifié
        $objectifs = Objectifs_user::with(['manager', 'agent'])
                                  ->where('agent_id', $agentId)
                                  ->get();

        return response()->json([
            'message' => 'Objectifs de l\'agent récupérés avec succès',
            'agent' => $agent->name ?? 'Agent',
            'data' => $objectifs
        ]);
    }

    //rejet d'un objectif
   public function rejeter(Request $request, $agentId,$userid)
    {
        $now = Carbon::now();

        // Vérifie si la période de fixation est active
        $cycleActif = Cycle::where('debut_fixation', '<=', $now)
                            ->where('fin_fixation', '>=', $now)
                            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "Vous ne pouvez pas Rejeter ces objectifs. Période dépasser ou pas ouverte."
            ], 403);
        }
        $request->validate([
            'commentaire' => 'required|string|max:2000',
        ]);

        $managerId = $userid;

        // Récupère tous les objectifs de l’agent associés à ce manager
        $objectifs = Objectifs_user::where('agent_id', $agentId)
                        ->where('manager_id', $managerId)
                        ->get();

        if ($objectifs->isEmpty()) {
            return response()->json([
                'message' => 'Aucun objectif trouvé ou non autorisé.'.$managerId.''.$agentId,
            ], 404);
        }

        foreach ($objectifs as $objectif) {
            // 1. Met à jour le statut
            $objectif->statut_objectif = 'Rejeter';
            $objectif->save();

            
        }
        // 2. Crée un commentaire lié à cet objectif
        Commentaire::create([
            'message'       => $request->commentaire,
            'auteur_id'     => $managerId,
            'role_auteur'   => 'Manager',
            'destinataire_id'   => $agentId,
            'date_creation' => now(),
        ]);

        return response()->json([
            'message' => 'Tous les objectifs de l’agent ont été rejetés avec succès.',
            'data' => $objectifs
        ]);
    }

    public function getObjectifsByUser($userId)
    {
        $objectifs = Objectifs_user::where('agent_id', $userId)->get();

        return response()->json($objectifs);
    }


    //fonction pour valider plusieurs objectifs
    public function validerTousObjectifs($agentId)
    {
        $now = Carbon::now();

        // Vérifie si la période de fixation est active
        $cycleActif = Cycle::where('debut_fixation', '<=', $now)
                            ->where('fin_fixation', '>=', $now)
                            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "Vous ne pouvez pas valider ces objectifs. Période dépasser ou pas ouverte."
            ], 403);
        }

        $objectifs = Objectifs_user::where('agent_id', $agentId)
                            ->get();

        if ($objectifs->isEmpty()) {
            return response()->json([
                'message' => "Aucun objectif trouvé ou vous n'êtes pas autorisé."
            ], 404);
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



    /**
     * Affiche un objectif spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objectif = Objectifs_user::with(['manager', 'agent'])->find($id);

        if (!$objectif) {
            return response()->json(['message' => 'Objectif not found'], 404);
        }

        return response()->json($objectif);
    }

    /**
     * Crée un nouvel objectif.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now();

        // Vérifie si la période de fixation est active
        $cycleActif = Cycle::where('debut_fixation', '<=', $now)
                            ->where('fin_fixation', '>=', $now)
                            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "La période de fixation des objectifs n'est pas ouverte."
            ], 403);
        }
        else{
            // Validation des données
            $validated = $request->validate([
                'titre' => 'required|string|max:255',
                'description' => 'required|string',
                'metric' => 'sometimes|required|in:Pourcentage,Score,Nombre,Temps',
                'valeur' => 'required|integer',
                'poids' => 'required|integer',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_debut',
                'statut_objectif' => 'sometimes|required|in:En Attente de Validation,Valider,Realiser,Rejeter',
                'manager_id' => 'required|exists:users,id',
                'agent_id' => 'required|exists:users,id',
            ]);

            // Création de l’objectif
            $objectif = Objectifs_user::create([
                'titre' => $validated['titre'],
                'description' => $validated['description'],
                'metric' => $validated['metric'] ?? 'Pourcentage',
                'valeur' => $validated['valeur'],
                'poids' => $validated['poids'],
                'date_debut' => $validated['date_debut'],
                'date_fin' => $validated['date_fin'],
                'statut_objectif' => $validated['statut_objectif'] ?? 'En Attente de Validation',
                'manager_id' => $validated['manager_id'],
                'agent_id' => $validated['agent_id'],
                'Cycle_id' => $cycleActif->id, // 🔗 Associer au cycle actif
            ]);

            // Charger les relations nécessaires
        $objectif->load('agent', 'manager');

        // ENVOYER EMAIL
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

        
    }


    /**
     * Met à jour un objectif spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $now = Carbon::now();

        // Vérifie si la période de fixation est active
        $cycleActif = Cycle::where('debut_fixation', '<=', $now)
                            ->where('fin_fixation', '>=', $now)
                            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "La période de fixation des objectifs n'est pas ouverte."
            ], 403);
        }


        $objectif = Objectifs_user::find($id);

        if (!$objectif) {
            return response()->json(['message' => 'Objectif not found'], 404);
        }

        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'metric' => 'nullable|in:Pourcentage,Score,Nombre,Temps',
            'valeur' => 'nullable|integer',
            'poids' => 'nullable|integer',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'statut_objectif' => 'nullable|in:En Attente de Validation,Valider,Realiser,Rejeter',
            'manager_id' => 'nullable|exists:users,id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        // Mise à jour des attributs de l'objectif uniquement si les champs sont fournis
        $objectif->update(array_filter([
            'titre' => $validated['titre'] ?? $objectif->titre,
            'description' => $validated['description'] ?? $objectif->description,
            'metric' => $validated['metric'] ?? $objectif->metric,
            'valeur' => $validated['valeur'] ?? $objectif->valeur,
            'poids' => $validated['poids'] ?? $objectif->poids,
            'date_debut' => $validated['date_debut'] ?? $objectif->date_debut,
            'date_fin' => $validated['date_fin'] ?? $objectif->date_fin,
            'statut_objectif' => $validated['statut_objectif'] ?? $objectif->statut_objectif,
            'manager_id' => $validated['manager_id'] ?? $objectif->manager_id,
            'agent_id' => $validated['agent_id'] ?? $objectif->agent_id,
        ]));

        return response()->json($objectif);
    }

    /**
     * Supprime un objectif spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $now = Carbon::now();

        // Vérifie si la période de fixation est active
        $cycleActif = Cycle::where('debut_fixation', '<=', $now)
                            ->where('fin_fixation', '>=', $now)
                            ->first();

        if (!$cycleActif) {
            return response()->json([
                'message' => "La période de fixation des objectifs n'est pas ouverte."
            ], 403);
        }

        
        $objectif = Objectifs_user::find($id);

        if (!$objectif) {
            return response()->json(['message' => 'Objectif not found'], 404);
        }

        $objectif->delete();

        return response()->json(['message' => 'Objectif deleted successfully']);
    }


}