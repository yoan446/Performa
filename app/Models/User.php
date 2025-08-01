<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'secondname',
        'email',
        'user_job_name',
        'direction_id',
        'statut_user',
        'password',
    ];

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }


    // L'utilisateur qui est son manager
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }


    // Les utilisateurs qu'il manage
    public function subordinates()
    {
        return $this->hasMany(User::class, 'manager_id');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');
    }

    // Vérifie si l'utilisateur a un rôle donné (string ou tableau)
    public function hasRole($role)
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('nom_role', $role)->exists();
        }
        return $this->roles()->where('nom_role', $role)->exists();
    }

    // Dans User.php
    public function hasRoleById($roleName)
    {
        return $this->roles()->where('nom_role', $roleName)->exists();
    }


    // Attribuer un rôle (par nom)
    public function assignRole($roleName)
    {
        $role = Role::where('nom_role', $roleName)->firstOrFail();
        $this->roles()->syncWithoutDetaching($role);
    }

    // Retirer un rôle (par nom)
    public function removeRole($roleName)
    {
        $role = Role::where('nom_role', $roleName)->first();
        if ($role) {
            $this->roles()->detach($role);
        }
    }

    public function comites()
    {
        return $this->belongsToMany(Comite::class, 'comites_responsables', 'user_id', 'comite_id');
    }

    public function comitesAsAgent()
    {
        return $this->belongsToMany(Comite::class, 'comite_agent', 'user_id', 'comite_id');
    }




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
