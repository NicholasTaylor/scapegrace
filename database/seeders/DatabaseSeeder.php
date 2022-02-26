<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissionsArr = [
            'edit users',
            'delete users',
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',
            'unpublish articles',
            'create categories',
            'edit categories',
            'delete categories',
            'create tags',
            'edit tags',
            'delete tags',
            'create roles',
            'edit roles',
            'delete roles',
            'change roles'
        ];
        foreach ($permissionsArr as $permission)
        {
            Permission::create(['name' => $permission]);
        }
        $superAdmin = Role::create(['name' => 'Super-Admin']);
        $user = \App\Models\User::factory()->create([
            'name' => env('SEEDER_USER_NAME'),
            'email' => env('SEEDER_USER_EMAIL'),
            'password' => Hash::make(env('SEEDER_USER_PASSWORD'))
        ]);
        $user->assignRole($superAdmin);
    }
}
