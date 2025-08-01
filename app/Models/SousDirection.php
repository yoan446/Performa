<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousDirection extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'chef_id',
        'direction_id',
        'nombre_employes',
    ];

    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
