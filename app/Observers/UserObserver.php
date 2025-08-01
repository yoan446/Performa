<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Direction;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Vérifie que l'utilisateur a un département
        if ($user->direction_id) {
            // Récupère le département
            $departement = Direction::find($user->direction_id);

            // Si le département existe et que le chef est défini
            if ($departement && $departement->chef !== null) {
                // Assigner le chef comme manager
                $user->manager_id = $departement->chef;

                // Sauvegarder la mise à jour du manager_id
                $user->save();
            }
        }
    }


    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // 
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
