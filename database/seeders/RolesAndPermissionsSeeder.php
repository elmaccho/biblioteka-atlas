<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Resetuje cache permisji
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Tworzenie permisji
        Permission::firstOrCreate(['name' => 'access admin panel']);
        Permission::firstOrCreate(['name' => 'access librarian panel']);

        // Tworzenie ról
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $librarianRole = Role::firstOrCreate(['name' => 'librarian']);

        // Przypisywanie permisji do ról
        $adminRole->givePermissionTo('access admin panel');
        $librarianRole->givePermissionTo('access librarian panel');
    }
}
