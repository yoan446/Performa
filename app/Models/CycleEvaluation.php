<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CycleEvaluation extends Model
{
    // Nom de la table si différent du pluriel du modèle
    protected $table = 'cycles_evaluation';

    // Clé primaire personnalisée
    protected $primaryKey = 'id_cycle';

    // Si la clé primaire est auto-incrémentée (par défaut true)
    public $incrementing = true;

    // Type de la clé primaire
    protected $keyType = 'int';

    // Champs assignables en masse (mass assignable)
    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'notation_max',
    ];

    // Si tu utilises les timestamps (created_at, updated_at)
    public $timestamps = true;

    // Relation avec le modèle Appreciation (si tu veux)
    public function appreciations()
    {
        return $this->hasMany(Appreciation::class, 'id_cycle', 'id_cycle');
    }
}
