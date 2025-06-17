<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Resetuje cache permisji
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::find(1);

        // Tworzenie permisji
        Permission::firstOrCreate(['name' => 'access admin panel']);
        Permission::firstOrCreate(['name' => 'access librarian panel']);

        // Tworzenie ról
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $librarianRole = Role::firstOrCreate(['name' => 'librarian']);

        // Przypisywanie permisji do ról
        $adminRole->givePermissionTo('access admin panel');
        $librarianRole->givePermissionTo('access librarian panel');

        if ($user) {
            // Przypisz rolę admin
            $user->assignRole($adminRole);
            $this->command->info('Admin role assigned to user ID 1.');
        } else {
            $this->command->error('User with ID 1 not found.');
        }
    }
}
