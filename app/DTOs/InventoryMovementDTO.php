<?php

namespace App\DTOs;

readonly class InventoryMovementDTO
{
    public function __construct(
        public int $product_id,
        public int $user_id,
        public float $quantity,
        public float $stock_before,
        public float $stock_after,
        public ?int $movable_id = null,
        public ?string $movable_type = null,
        public ?string $concept = null,
    ) {}

}