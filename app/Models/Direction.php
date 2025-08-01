<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'chef', 'employee_count'];

    /**
     * Relation : une direction a plusieurs sous-directions.
     */
    public function sousDirections()
    {
        return $this->hasMany(SousDirection::class);
    }
}



