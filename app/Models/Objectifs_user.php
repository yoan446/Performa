<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Objectifs_user extends Model
{
     use HasFactory;

    // Définir les colonnes autorisées pour l'assignation de masse (Mass Assignment)
    protected $fillable = [
        'titre',
        'description',
        'metric',
        'valeur',
        'poids',
        'date_debut',
        'date_fin',
        'statut_objectif',
        'manager_id',
        'agent_id',
        'id_cycle'
    ];


    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

     public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function cycle()
    {
        return $this->belongsTo(CycleEvaluation::class, 'id_cycle');
    }
    
}
