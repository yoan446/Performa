<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Action;
use App\Models\PeriodeAction;
use Carbon\Carbon;

class CheckActionPeriod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();

        $currentUrl = $request->route()->uri(); // ex: objectifs/store
        //$method = $request->method();

        // Cherche l'action correspondante dans la table actions
        $action = Action::where('url_endpoints', $currentUrl)->first();

        if (!$action) {
            return response()->json(['message' => 'Action non enregistrée.', 'action' => $currentUrl], 403);
           
        }
        

        // Vérifie si une période valide existe pour cette action
        $periodeActive = PeriodeAction::where('id_action', $action->id)
            ->where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->exists();

        if (!$periodeActive) {
            return response()->json([
                'message' => 'Cette action n\'est pas autorisée à cette période.'
            ], 403);
        }

        return $next($request);
    }
}
