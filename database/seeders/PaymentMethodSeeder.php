<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Efectivo',
                'type' => 'cash',
                'is_active' => true,
            ],
            [
                'name' => 'Transferencia Bancaria',
                'type' => 'bank',
                'is_active' => true,
            ],
            [
                'name' => 'Tarjeta de Débito',
                'type' => 'card',
                'is_active' => true,
            ],
            [
                'name' => 'Tarjeta de Crédito',
                'type' => 'card',
                'is_active' => true,
            ],
            [
                'name' => 'Mercado Pago / QR',
                'type' => 'e-wallet',
                'is_active' => true,
            ],
            [
                'name' => 'Cuenta Corriente',
                'type' => 'credit',
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::updateOrCreate(['name' => $method['name']], $method);
        }
    }
}
