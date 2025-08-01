<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Direction;
use App\Models\User;
use App\Observers\DirectionObserver;
use App\Observers\UserObserver;
use App\Http\Middleware\PreventBackHistory;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Direction::observe(DirectionObserver::class);
        User::observe(UserObserver::class);

    }
}
