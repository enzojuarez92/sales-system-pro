<?php

namespace Database\Seeders;

use App\Models\TaxCondition;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'super@admin.com',
            'username' => 'superadmin',
            'password' => Hash::make('admin')
        ]);

        $user->assignRole('admin');

        $this->call(RoleSeeder::class);
        $this->call(TaxConditionSeeder::class);
    }
}
