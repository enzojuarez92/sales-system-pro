<?php

namespace App\DTOs;

readonly class PurchaseItemDTO
{
    public function __construct(
        public int $purchase_id,
        public int $product_id,
        public float $quantity,
        public float $cost_price,
        public float $tax_amount,
        public float $subtotal
    ) {}
}