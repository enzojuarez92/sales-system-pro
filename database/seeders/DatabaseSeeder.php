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

        $this->call(RoleSeeder::class);
        $this->call(TaxConditionSeeder::class);
        $this->call(BankAccountSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'super@admin.com';
        $user->username = 'superadmin';
        $user->password = Hash::make('admin');
        $user->save();
        $user->assignRole('admin');

    }
}
