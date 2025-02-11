<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'super admin',
            'email' => 'sa@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $users = User::find(1);

        $roles = Role::find(1);
        $permission = Permission::all();

        $roles->syncPermissions($permission);

        $users->assignRole($roles);
    }
}
