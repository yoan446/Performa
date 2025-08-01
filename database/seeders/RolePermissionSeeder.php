<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vider le cache Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Définir les rôles
        $roles = ['Agent', 'Manager', 'Administrateur', 'Comité', 'RH'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Définir les permissions selon les responsabilités
        $permissions = [
            // Agent
            'objectifs.agent.crud',
            'auto_evaluation.crud',
            'profile.edit',
            'historique.consultation',

            // Manager
            'objectifs.collaborateurs.consultation',
            'auto_evaluations.collaborateurs.consultation',
            'evaluations.collaborateurs.crud',
            'objectifs.collaborateurs.validation',
            'objectifs.collaborateurs.rejet',

            // Administrateur
            'configuration.systeme',

            // Comité
            'performances.direction.visualisation',
            'performances.unite.visualisation',
            'note.comite.crud',

            // RH
            'performances.globales.visualisation',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Attribution des permissions aux rôles

        // Agent
        Role::where('name', 'Agent')->first()->givePermissionTo([
            'objectifs.agent.crud',
            'auto_evaluation.crud',
            'profile.edit',
            'historique.consultation',
        ]);

        // Manager
        Role::where('name', 'Manager')->first()->givePermissionTo([
            'objectifs.collaborateurs.consultation',
            'auto_evaluations.collaborateurs.consultation',
            'evaluations.collaborateurs.crud',
            'objectifs.collaborateurs.validation',
            'objectifs.collaborateurs.rejet',
        ]);

        // Administrateur
        Role::where('name', 'Administrateur')->first()->givePermissionTo([
            'configuration.systeme',
        ]);

        // Comité
        Role::where('name', 'Comité')->first()->givePermissionTo([
            'performances.direction.visualisation',
            'performances.unite.visualisation',
            'note.comite.crud',
        ]);

        // RH
        Role::where('name', 'RH')->first()->givePermissionTo([
            'performances.globales.visualisation',
        ]);

        // Exemple d’affectation de rôle à l’utilisateur ID 1
        $user = User::find(2);
        if ($user) {
            $user->assignRole(['Manager', 'Agent','Administrateur']);
        }

    }
}
