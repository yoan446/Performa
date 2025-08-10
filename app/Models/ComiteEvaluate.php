<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComiteEvaluate extends Model
{
    // Table associée
    protected $table = 'comites_agents';

    // Pas de timestamps sur cette table pivot sauf si tu les as ajoutés
    public $timestamps = false;

    // Colonnes autorisées à être assignées en masse
    protected $fillable = [
        'comite_id',
        'user_id',
    ];

    /**
     * Relation avec le comité
     */
    public function comite()
    {
        return $this->belongsTo(Comite::class, 'comite_id');
    }

    /**
     * Relation avec l'utilisateur évalué
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
