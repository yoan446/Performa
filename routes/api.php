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
    //Utilisateurs
    // =====================
    Route::resource('users', UserController::class);
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
    //Appreciations OK
    // =====================
    Route::resource('appreciations', AppreciationController::class);

    // =====================
    //Cycles évaluation ok
    // =====================
    Route::resource('cycles', CycleEvaluationController::class);

    // =====================
    //Rôles ok
    // =====================
    Route::resource('roles', RoleController::class);

    // =====================
    //Actions ok
    // =====================
    Route::resource('actions', ActionController::class);

    //=============================
    //Période associé à une action ok
    //=============================
    Route::resource('periodes-actions', PeriodeActionController::class);

    //==============================
    //Metrics pour les objectifs ok
    //=============================
    Route::resource('metrics', MetricController::class);

    //=============================================
    //Statuts pour les objectifs et evaluations ok
    //=============================================
    Route::resource('statuts', StatutController::class);

});