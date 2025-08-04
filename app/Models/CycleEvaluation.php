<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CycleEvaluation extends Model
{
    // Nom de la table
    protected $table = 'cycles_evaluation';

    // Clé primaire personnalisée
    protected $primaryKey = 'id_cycle';
    public $incrementing = true;
    protected $keyType = 'int';

    // Champs assignables
    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'notation_max',
    ];

    public $timestamps = true;

    /**
     * Relation avec les appréciations.
     */
    public function appreciations(): HasMany
    {
        return $this->hasMany(Appreciation::class, 'id_cycle', 'id_cycle');
    }

    /**
     * Relation avec les périodes d'action.
     */
    public function periodes(): HasMany
    {
        return $this->hasMany(PeriodeAction::class, 'cycle_id', 'id_cycle');
    }

    /**
     * Vérifie si le cycle est actuellement actif.
     */
    public function estActif(): bool
    {
        $now = now();

        return $this->date_debut <= $now && $this->date_fin >= $now;
    }
}
