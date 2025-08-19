<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Models\Appreciation;
use App\Models\Action;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\CycleEvaluationController;
use App\Http\Controllers\UserController;
use App\Models\Comite;
use App\Models\CycleEvaluation;  // Utilisation du modèle CycleEvaluation

Route::get('/', function () {
    return view('login');
})->name('login');

// Route pour la page des évaluations des collaborateurs
Route::get('/evaluation-collaborateur', function () {
    return view('collaborator-evaluations');
});

// Route pour la gestion des objectifs d'un collaborateur
Route::get('/collaborator-objective', function () {
    return view('collaborator-objective');
})->name('collaborator-objective');

// Route pour la gestion des périodes
Route::get('/user-manage-action', function () {
    // Récupérer les cycles via CycleEvaluation
    $controller = app(CycleEvaluationController::class);  // Utiliser le bon contrôleur
    $cycles = $controller->index(); // Cette méthode doit renvoyer une collection ou un tableau
    return view('user-manage-action', compact('cycles'));
})->name('user-manage-action');

// Route pour le tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route pour créer un objectif
Route::get('/user-create-objective', function () {
    return view('user-create-objective');
})->name('user-create-objective');

// Route pour la page d'auto-évaluation
Route::get('/dashboard-self-evaluation', function () {
    $userId = session('user_id');  // Tu peux récupérer ces données d'une autre manière sans utiliser la session si nécessaire
    $objectifs = \App\Models\Objectifs_user::where('agent_id', $userId)->get();
    return view('dashboard-self-evaluation', compact('objectifs'));
})->name('dashboard-self-evaluation');

// Route pour l'historique des évaluations
Route::get('/user-history', function () {
    return view('user-history');
})->name('user-history');

// Route pour les évaluations des collaborateurs
Route::get('/collaborator-evaluations', function () {
    return view('collaborator-evaluations');
})->name('collaborator-evaluations');

// Route pour créer une évaluation de collaborateur
Route::get('/user-create-collaborator-evaluation', function () {
    // Récupère les appréciations (id, code, description)
    $appreciations = Appreciation::select('id', 'code', 'description')->orderBy('id')->get();
    return view('user-create-collaborator-evaluation', compact('appreciations'));
})->name('user-create-collaborator-evaluation');

// Route pour gérer le profil utilisateur
Route::get('/user-manage-profile', function () {
    return view('user-manage-profile');
})->name('user-manage-profile');

// Route pour gérer les cycles
Route::get('/user-manage-cycle', function () {
    return view('user-manage-cycle');
})->name('user-manage-cycle');

// Route pour la création de périodes
Route::get('/user-create-period-management', function () {
    $cycles = CycleEvaluation::all();
    $actions = Action::all();
    return view('user-create-period-management', compact('cycles','actions'));
})->name('user-create-period-management');

// Route pour créer un comité
Route::get('/create-comite', function () {
    $comites = Comite::with('cycle')->get(); // Si relation définie
    $cycles = CycleEvaluation::all();
    return view('create-comite', compact('comites', 'cycles'));
})->name('create-comite');

// Route pour gérer les responsable
Route::get('/create-comite-responsable', function () {
    // Récupérer les comités
    $comites = Comite::with('cycle')->get();

    // Récupérer les utilisateurs ayant le rôle "comite"
    $usersWithRoleComite = User::whereHas('roles', function ($query) {
        $query->where('nom_role', 'comite'); // Assurez-vous que le nom du rôle est "comite"
    })->get();

    // Passer les données aux vues
    return view('create-comite-responsable', compact('comites', 'usersWithRoleComite'));
})->name('create-comite-responsable');

// Route pour gérer les agents évalués
Route::get('/create-comite-member', function () {
    return view('create-comite-member');
})->name('create-comite-member');

// Route pour la gestion des utilisateurs dans l'organisation
Route::get('/user-create-organisation-management', function () {
    // Récupération des statistiques utilisateur
    $totalUsers = User::count();
    $activeUsers = User::where('statut_user', 'Actif')->count();
    $inactiveUsers = User::where('statut_user', 'Inactif')->count();
    $roles = Role::select('id', 'nom_role')->orderBy('id')->get();

    return view('user-create-organisation-management', compact('totalUsers', 'activeUsers', 'inactiveUsers', 'roles'));
})->name('user-create-organisation-management');

// Route pour l'auto-évaluation de l'utilisateur
Route::get('/user-create-self-evaluation', function () {
    // Récupère les appréciations (id, code, description)
    $appreciations = Appreciation::select('id', 'code', 'description')->orderBy('id')->get();
    return view('user-create-self-evaluation', compact('appreciations'));
})->name('user-create-self-evaluation');

// Routes de connexion et déconnexion
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
