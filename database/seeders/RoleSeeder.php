<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Creamos los Roles
        $admin = Role::create(['name' => 'admin']);
        $seller = Role::create(['name' => 'seller']);

        // 2. Creamos los Permisos 
        Permission::create(['name' => 'manage taxes'])->assignRole($admin);
        Permission::create(['name' => 'manage categories'])->assignRole($admin);
        Permission::create(['name' => 'create invoices'])->syncRoles([$admin, $seller]);
        Permission::create(['name' => 'view reports'])->assignRole($admin);

       
    }
}
