<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';

    /**
     * Attributs pouvant être assignés en masse.
     */
    protected $fillable = [
        'evaluation_id',
        'destinataire_id',
        'auteur_id',
        'message',
        'role_auteur',
        'date_creation',
    ];

    /**
     * Relations.
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }

    public function objectif()
    {
        return $this->belongsTo(Objectifs_user::class, 'objectif_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
}
