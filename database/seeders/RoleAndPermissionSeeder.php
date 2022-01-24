<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit todo']);
        Permission::create(['name' => 'delete todo']);

        //create user role  
        Role::create(['name' => 'user']);

        // create admin role and assign all permissions
        $adminRole = Role::create(['name' => 'admin'])
        ->givePermissionTo(Permission::all());

        // Account for Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
        ]);
        // assigning admin role to admin
        $admin->assignRole($adminRole);

        // assigning all permision to admin
        $admin->givePermissionTo('edit todo', 'delete todo');



         
    }
}
