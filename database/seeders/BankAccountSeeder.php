<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /// database/seeders/BankAccountSeeder.php
    public function run(): void
    {
        \App\Models\BankAccount::updateOrCreate(
            ['name' => 'Caja Chica / Efectivo'],
            ['type' => 'cash', 'current_balance' => 0]
        );

        \App\Models\BankAccount::updateOrCreate(
            ['name' => 'Banco Santander'],
            ['type' => 'bank', 'current_balance' => 0]
        );
    }
}
