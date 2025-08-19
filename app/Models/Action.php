<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Action extends Model
{
    protected $table = 'actions';

    protected $fillable = [
        'url_endpoints',
        'description',
        'nom_module',
        'method'
    ];

    /**
     * Une action peut être liée à plusieurs périodes d'exécution.
     */
    public function periodes(): HasMany
    {
        return $this->hasMany(PeriodeAction::class, 'id_action');
    }

    /**
     * Vérifie si l'action est actuellement dans une période active.
     */
    public function estActive(): bool
    {
        $now = now();

        return $this->periodes()
            ->where('date_debut', '<=', $now)
            ->where('date_fin', '>=', $now)
            ->exists();
    }
}
