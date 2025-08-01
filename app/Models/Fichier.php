<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fichier extends Model
{
    use HasFactory;

    protected $table = 'fichiers';

    protected $fillable = [
        'evaluation_id',
        'url_fichier',
        'auteur_id',
    ];

    public function evaluation()
    {
        return $this->belongsTo(EvaluationObjectif::class, 'evaluation_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
}
