<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comite extends Model
{
    protected $table = 'comites';

    protected $fillable = [
        'nom_comite',
        'cycle_id',
    ];

    // Relation vers Cycle
    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }

   

    public function responsables()
    {
        return $this->belongsToMany(User::class, 'comites_responsables', 'comite_id', 'user_id');
    }

    public function agents()
    {
        return $this->belongsToMany(User::class, 'comite_agent', 'comite_id', 'user_id');
    }
}
