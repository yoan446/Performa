<?php

namespace App\Observers;

use App\Models\Direction;
use App\Models\User;

class DirectionObserver
{
    /**
     * Handle the Direction "created" event.
     */
    public function created(Direction $direction): void
    {
        //
    }

    /**
     * Handle the Direction "updated" event.
     */
    public function updated(Direction $direction): void
    {
        // Vérifie si le champ 'chef' a été modifié
        if ($direction->wasChanged('chef')) {
            // Mettre à jour le champ manager_id des utilisateurs de cette direction
            User::where('direction_id', $direction->id)
            ->where('role_user', '!=', 'Manager')
            ->update(['manager_id' => $direction->chef]);
        }
    }

    /**
     * Handle the Direction "deleted" event.
     */
    public function deleted(Direction $direction): void
    {
        //
    }

    /**
     * Handle the Direction "restored" event.
     */
    public function restored(Direction $direction): void
    {
        //
    }

    /**
     * Handle the Direction "force deleted" event.
     */
    public function forceDeleted(Direction $direction): void
    {
        //
    }
}
