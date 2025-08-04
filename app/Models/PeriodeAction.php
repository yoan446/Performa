<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeAction extends Model
{
    protected $table = 'periodes_actions';

    // Champs remplissables
    protected $fillable = [
        'id_action',
        'cycle_id',
        'date_debut',
        'date_fin',
    ];

    // Relation vers l'action associée
    public function action()
    {
        return $this->belongsTo(Action::class, 'id_action');
    }

    // Relation vers le cycle associé
    public function cycle()
    {
        return $this->belongsTo(CycleEvaluation::class, 'cycle_id', 'id_cycle'); // adapte si la PK est 'id'
    }
}
