<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = [
            ['name' => 'Consumidor Final'],
            ['name' => 'Monotributista'],
            ['name' => 'Responsable Inscripto'],
            ['name' => 'Exento'],
            ['name' => 'No Responsable'],
        ];

        foreach ($conditions as $condition) {
            \App\Models\TaxCondition::create($condition);
        }
    }
}
