<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Injecter $user et $roles dans toutes les vues
        View::composer('*', function ($view) {
            $user = Auth::user();
            $roles = $user ? $user->roles->pluck('nom_role')->toArray() : [];

            $view->with('connectedUser', $user);
            $view->with('userRoles', $roles);
        });
    }
}
