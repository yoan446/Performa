<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory;
     protected $table = 'Evaluations';

    protected $fillable = [
        'objectif_id',
        'agent_id',
        'manager_id',
        'comite_id',
        'note_auto_eval',
        'note_manager',
        'note_comite',
        'cycle_id',
    ];

    // Relation avec les fichiers
    public function fichiers()
    {
        return $this->hasMany(Fichier::class, 'evaluation_id');
    }

    // Relation avec les commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'evaluation_id');
    }

    // Relations avec les utilisateurs
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function comite()
    {
        return $this->belongsTo(Comite::class, 'comite_id');
    }

    // Relation avec l’objectif évalué
    public function objectif()
    {
        return $this->belongsTo(Objectifs_user::class, 'objectif_id');
    }


    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }

}
