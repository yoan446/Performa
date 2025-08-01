<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Models\Appreciation;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\UserController;
use App\Models\Comite;
use App\Models\Cycle;

Route::get('/', function () {
    return view('login');
})->name('login');



Route::get('/evaluation-collaborateur', function () {
    if (!session()->has('user_id')) {
         return view('login')->with('error', 'Veuillez vous connecter.');
    }

    return view('collaborator-evaluations');
});


Route::get('/collaborator-objective', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }
    return view('collaborator-objective');
})->name('collaborator-objective');


Route::get('/user-manage-period', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }

    // On exécute la méthode index() du contrôleur
    $controller = app(CycleController::class);
    $cycles = $controller->index(); // cette fonction doit renvoyer une collection ou un tableau
    return view('user-manage-period', compact('cycles'));
})->name('user-manage-period');



Route::get('/dashboard', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }
    $userId = session('user_id');
    $objectifs = \App\Models\Objectifs_user::where('agent_id', $userId)->get();

    $objectives = \App\Models\Objectifs_user::where('agent_id', $userId)
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
    return view('dashboard', compact('objectifs','stats'));
})->name('dashboard');


Route::get('/user-create-objective', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error','Veuillez vous connecter.');
    }
    return view('user-create-objective');
})->name('user-create-objective');


Route::get('/dashboard-self-evaluation', function () {
    if (!session()->has('user_id')) {
       return view('login')->with('error', 'Veuillez vous connecter.');
    }
    $userId = session('user_id');
    $objectifs = \App\Models\Objectifs_user::where('agent_id', $userId)->get();
    return view('dashboard-self-evaluation', compact('objectifs'));
})->name('dashboard-self-evaluation');


Route::get('/user-history', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }
    return view('user-history');
})->name('user-history');


Route::get('/collaborator-evaluations', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }
    return view('collaborator-evaluations');
})->name('collaborator-evaluations');


Route::get('/user-create-collaborator-evaluation', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }
    // 2) Récupère les appréciations (id, code, description)
    $appreciations = Appreciation::select('id', 'code', 'description')->orderBy('id')->get();
    //Envoie la liste à la vue
    return view('user-create-collaborator-evaluation', compact('appreciations'));
})->name('user-create-collaborator-evaluation');


Route::get('/user-manage-profile', function () {
    if (!session()->has('user_id')) {
       return view('login')->with('error', 'Veuillez vous connecter.');
    }
        return view('user-manage-profile');
})->name('user-manage-profile');


Route::get('/user-create-period-management', function () {
    if (!session()->has('user_id')) {
       return view('login')->with('error', 'Veuillez vous connecter.');
    }
        return view('user-create-period-management');
})->name('user-create-period-management');


Route::get('/create-comite', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }

    $comites = Comite::with('cycle')->get(); // Si relation définie
    $cycles = Cycle::all();

    return view('create-comite', compact('comites', 'cycles'));
})->name('create-comite');


Route::get('/user-create-organisation-management', function () {
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }

    // Récupération des statistiques utilisateur
    $totalUsers = User::count();
    $activeUsers = User::where('statut_user', 'Actif')->count();
    $inactiveUsers = User::where('statut_user', 'Inactif')->count();
    // 2) Récupère les appréciations (id, code, description)
    $roles = Role::select('id', 'nom_role')->orderBy('id')->get();

    return view('user-create-organisation-management', compact('totalUsers','activeUsers','inactiveUsers','roles'));
})->name('user-create-organisation-management');


Route::get('/user-create-self-evaluation', function () {
    // 1) Vérifie la session
    if (!session()->has('user_id')) {
        return view('login')->with('error', 'Veuillez vous connecter.');
    }
    // 2) Récupère les appréciations (id, code, description)
    $appreciations = Appreciation::select('id', 'code', 'description')->orderBy('id')->get();
    //Envoie la liste à la vue
    return view('user-create-self-evaluation', compact('appreciations'));
})->name('user-create-self-evaluation');


Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

















