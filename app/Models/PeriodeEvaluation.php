<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeEvaluation extends Model
{
    protected $table = 'periodes_evaluations';

    // Les champs modifiables
    protected $fillable = [
        'id_cycle_eval',
        'nom_phase',
        'date_debut',
        'date_fin',
    ];

    // Relation vers le cycle d'évaluation (un période appartient à un cycle)
    public function cycleEvaluation()
    {
        return $this->belongsTo(CycleEvaluation::class, 'id_cycle_eval', 'id_cycle');
    }
}
