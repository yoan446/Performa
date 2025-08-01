<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObjectifUserController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AppreciationController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");


//route pour le login qui n'est pas protégé
Route::post('login', [AuthController::class, 'login']);

//route pour protéger avec le auth:api
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::prefix('comites')->group(function () {
    Route::get('/', [ComiteController::class, 'index']);        // Lister tous les comités
    Route::post('/', [ComiteController::class, 'store']);       // Créer un nouveau comité
    Route::get('{id}', [ComiteController::class, 'show']);      // Afficher un comité spécifique
    Route::put('{id}', [ComiteController::class, 'update']);    // Modifier un comité
    Route::delete('{id}', [ComiteController::class, 'destroy']); // Supprimer un comité
});

Route::resource('appreciations', AppreciationController::class);

Route::resource('/users', UserController::class);

//fonction pour  recuperer tous les agents d'un maanager
Route::get('/managers/{id}/collaborateurs', [UserController::class, 'collaborateursDuManager']);

Route::resource('roles', RoleController::class);

Route::resource('objectifs', ObjectifUserController::class);

Route::post('/objectifs', [ObjectifUserController::class, 'store'])->name('objectifs.store');

Route::get('/users/{userId}/objectifs', [ObjectifUserController::class, 'getObjectifsByUser']);

// Objectifs gérés par le manager connecté
Route::get('/manager/objectifs/agent/{agentId}', [ObjectifUserController::class, 'getObjectifsAgentPourManager']);

// Objectifs d'un agent spécifique
Route::get('/objectifs/agent/{agentId}', [ObjectifUserController::class, 'getObjectifsBySpecificAgent']);

//route pour le rejet d'un objectif
Route::post('/objectifs/{agentId}/rejeter/{userId}', [ObjectifUserController::class, 'rejeter']);



// Valider tous les objectifs d’un agent (par un manager)
Route::post('/agents/{agentId}/objectifs/valider-tous', [ObjectifUserController::class, 'validerTousObjectifs']);

//route pour +les cycles
Route::resource('/cycles', CycleController::class);

//afficher les stats du user connecter
Route::get('/objectif/statistique/{id}', [ObjectifUserController::class, 'statistique']);

//route pour le controller Evaluation Objectifs
Route::get('/evaluations', [EvaluationController::class, 'index']);

Route::get('/evaluations/{id}', [EvaluationController::class, 'show']);

Route::post('/evaluations_agent', [EvaluationController::class, 'store_agent']);

Route::post('/evaluations_manager', [EvaluationController::class, 'store_manager']);

Route::post('/evaluations_comite', [EvaluationController::class, 'store_comite']);

Route::put('/evaluations/{id}', [EvaluationController::class, 'update']);

Route::delete('/evaluations/{id}', [EvaluationController::class, 'destroy']);

// Routes spécifiques
Route::get('/evaluations/agent/{agentId}', [EvaluationController::class, 'evaluationsParAgent']);
Route::get('/evaluations/manager/{agentId}', [EvaluationController::class, 'evaluationsAgentParManager']);