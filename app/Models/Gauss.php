<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gauss extends Model
{
    use HasFactory;

    protected $table = 'gauss';

    protected $fillable = [
        'comite_id',
        'appreciation_id',
        'quota_max',
    ];

    // Relation vers Comite
    public function comite()
    {
        return $this->belongsTo(Comite::class);
    }

    // Relation vers Appreciation
    public function appreciation()
    {
        return $this->belongsTo(Appreciation::class);
    }
}
