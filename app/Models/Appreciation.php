<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appreciation extends Model
{
    use HasFactory;

    /**
     * Attributs pouvant être assignés en masse.
     */
    protected $fillable = [
        'code',          // ex. "SG", "NI", …
        'description',   // ex. "Sous-Objectif", "Non impactant", …
        'valeur_min',    // Valeur minimale associée
        'valeur_max',    // Valeur maximale associée
    ];
}
