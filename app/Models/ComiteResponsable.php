<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ComiteResponsable extends Pivot
{
    protected $table = 'comites_responsables';

    protected $fillable = [
        'user_id',
        'comite_id',
    ];

    public $timestamps = false;

    // Optionnel : relations inverse pour simplifier les accès
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comite()
    {
        return $this->belongsTo(Comite::class);
    }
}
