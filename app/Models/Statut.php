<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
   protected $table = 'statuts';

    // Les champs qui peuvent être assignés en masse
    protected $fillable = [
        'libelle',
        'module',
    ];
}
