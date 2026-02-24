<?php

namespace App\Contracts;

use App\Models\InventoryMovement;
use Illuminate\Support\Collection;

interface InventoryMovementRepositoryInterface
{
    public function getAll(): Collection;
    public function findByProduct(int $productId): Collection;
    public function create(array $data): InventoryMovement;
}