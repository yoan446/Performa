<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_cycle',
        'debut_cycle',
        'fin_cycle',
        'debut_fixation',
        'fin_fixation',
        'debut_auto_eval',
        'fin_auto_eval',
        'debut_eval_manager',
        'fin_eval_manager',
        'debut_eval_comite',
        'fin_eval_comite',
    ];

    /**
     * Relation avec les objectifs liés à ce cycle.
     */
    public function objectifs()
    {
        return $this->hasMany(Objectifs_user::class, 'Cycle_id');
    }

    /**
     * Relation avec les évaluations liées à ce cycle.
     */
    public function evaluations()
    {
        return $this->hasMany(EvaluationObjectif::class, 'Cycle_id');
    }
}
