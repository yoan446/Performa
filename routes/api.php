<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    ComiteController,
    ObjectifUserController,
    EvaluationController,
    AppreciationController,
    CycleEvaluationController,
    RoleController,
    ActionController,
    PeriodeActionController,
    MetricController,
    StatutController,
    ComiteResponsableController,
    ComiteEvalueController
};

//Route publique (non protégée)
Route::post('login', [AuthController::class, 'login']);

//Routes protégées (auth:api)
Route::middleware('auth:api')->group(function () {

    // =====================
    // Auth ok
    // =====================
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // =====================
    // Utilisateurs
    // =====================
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);       // Liste des utilisateurs
        Route::post('/', [UserController::class, 'store']);      // Créer un utilisateur
        Route::get('{id}', [UserController::class, 'show']);     // Afficher un utilisateur
        Route::put('{id}', [UserController::class, 'update']);   // Modifier un utilisateur
        Route::delete('{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur
    });
    Route::get('/managers/{id}/collaborateurs', [UserController::class, 'collaborateursDuManager']);

    

    Route::middleware(['check.period'])->group(function () {
        // =====================
        //Objectifs OK
        // =====================
        Route::prefix('objectifs')->group(function () {
            Route::get('/', [ObjectifUserController::class, 'index']);
            Route::post('/', [ObjectifUserController::class, 'store'])->name('objectifs.store');
            Route::get('/{id}', [ObjectifUserController::class, 'show']);
            Route::put('/{id}', [ObjectifUserController::class, 'update']);
            Route::delete('/{id}', [ObjectifUserController::class, 'destroy']);
            Route::get('/users/{userId}/objectifs', [ObjectifUserController::class, 'getObjectifsByUser']);
            Route::get('/statistique/{id}', [ObjectifUserController::class, 'statistique']);
            Route::post('/{agentId}/rejeter/{userId}', [ObjectifUserController::class, 'rejeter']);
            Route::post('/{agentId}/objectifs/valider-tous', [ObjectifUserController::class, 'validerTousObjectifs']);
            //récupere les objectifs en fonction du cycle
            Route::get('/cycles/{id}/objectifs', [ObjectifUserController::class, 'getObjectifsByCycles']);

        });

        // =====================
        //Evaluations
        // =====================
        Route::prefix('evaluations')->group(function () {
            Route::get('/', [EvaluationController::class, 'index']);
            Route::get('/{id}', [EvaluationController::class, 'show']);
            Route::post('/evaluations_agent', [EvaluationController::class, 'store_agent']);
            Route::post('/evaluations_manager', [EvaluationController::class, 'store_manager']);
            Route::post('/comite', [EvaluationController::class, 'store_comite']);
            Route::put('/{id}', [EvaluationController::class, 'update']);
            Route::delete('/{id}', [EvaluationController::class, 'destroy']);

            // Evaluations filtrées
            Route::get('/agent/{agentId}', [EvaluationController::class, 'evaluationsParAgent']);
            Route::get('/manager/{agentId}', [EvaluationController::class, 'evaluationsAgentParManager']);
        });
    });

    

    // =====================
    //Comités OK
    // =====================
    Route::prefix('comites')->group(function () {
        Route::get('/', [ComiteController::class, 'index']);
        Route::post('/', [ComiteController::class, 'store']);
        Route::get('/{id}', [ComiteController::class, 'show']);
        Route::put('/{id}', [ComiteController::class, 'update']);
        Route::delete('/{id}', [ComiteController::class, 'destroy']);
    });


    //======================
    //Comités responsable OK
    //======================
    
   Route::prefix('comite-responsable')->group(function () {
        Route::get('/{comiteId}', [ComiteResponsableController::class, 'index']);       
        Route::post('/{comiteId}', [ComiteResponsableController::class, 'store']);
        Route::put('/{comiteId}', [ComiteResponsableController::class, 'update']);
        Route::delete('/{comiteId}/{userId}', [ComiteResponsableController::class, 'detach']);
    });


    //============================
    //Comités personne evalué OK 
    //============================

    Route::prefix('comite-evalue')->group(function () {
        Route::get('{comiteId}', [ComiteEvalueController::class, 'index']);
        Route::post('{comiteId}', [ComiteEvalueController::class, 'store']);
        Route::put('{comiteId}', [ComiteEvalueController::class, 'update']);
        Route::delete('{comiteId}/{userId}', [ComiteEvalueController::class, 'detach']);
    });

    // =====================
    // Appreciations
    // =====================
    Route::prefix('appreciations')->group(function () {
        Route::get('/', [AppreciationController::class, 'index']);     // Liste des appréciations
        Route::post('/', [AppreciationController::class, 'store']);    // Création d'une appréciation
        Route::get('{id}', [AppreciationController::class, 'show']);   // Afficher une appréciation
        Route::put('{id}', [AppreciationController::class, 'update']); // Modifier une appréciation
        Route::delete('{id}', [AppreciationController::class, 'destroy']); // Supprimer une appréciation
    });

    // =====================
    // Cycles évaluation
    // =====================
    Route::prefix('cycles')->group(function () {
        Route::get('/', [CycleEvaluationController::class, 'index']);
        Route::post('/', [CycleEvaluationController::class, 'store']);
        Route::get('{id}', [CycleEvaluationController::class, 'show']);
        Route::put('{id}', [CycleEvaluationController::class, 'update']);
        Route::delete('{id}', [CycleEvaluationController::class, 'destroy']);
    });

    // =====================
    // Rôles
    // =====================
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::get('{id}', [RoleController::class, 'show']);
        Route::put('{id}', [RoleController::class, 'update']);
        Route::delete('{id}', [RoleController::class, 'destroy']);
    });

    // =====================
    // Actions
    // =====================
    Route::prefix('actions')->group(function () {
        Route::get('/', [ActionController::class, 'index']);
        Route::post('/', [ActionController::class, 'store']);
        Route::get('{id}', [ActionController::class, 'show']);
        Route::put('{id}', [ActionController::class, 'update']);
        Route::delete('{id}', [ActionController::class, 'destroy']);
    });

    // =====================
    // Périodes associées à une action
    // =====================
    Route::prefix('periodes-actions')->group(function () {
        Route::get('/', [PeriodeActionController::class, 'index']);
        Route::post('/', [PeriodeActionController::class, 'store']);
        Route::get('{id}', [PeriodeActionController::class, 'show']);
        Route::put('{id}', [PeriodeActionController::class, 'update']);
        Route::delete('{id}', [PeriodeActionController::class, 'destroy']);
    });

    // =====================
    // Metrics pour les objectifs
    // =====================
    Route::prefix('metrics')->group(function () {
        Route::get('/', [MetricController::class, 'index']);
        Route::post('/', [MetricController::class, 'store']);
        Route::get('{id}', [MetricController::class, 'show']);
        Route::put('{id}', [MetricController::class, 'update']);
        Route::delete('{id}', [MetricController::class, 'destroy']);
    });

    // =====================
    // Statuts pour objectifs & évaluations
    // =====================
    Route::prefix('statuts')->group(function () {
        Route::get('/', [StatutController::class, 'index']);
        Route::post('/', [StatutController::class, 'store']);
        Route::get('{id}', [StatutController::class, 'show']);
        Route::put('{id}', [StatutController::class, 'update']);
        Route::delete('{id}', [StatutController::class, 'destroy']);
    });


});