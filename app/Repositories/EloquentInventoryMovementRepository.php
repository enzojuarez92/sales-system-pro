<?php 

namespace App\Repositories;

use App\Contracts\InventoryMovementRepositoryInterface;
use App\Models\InventoryMovement;
use Illuminate\Support\Collection;

class EloquentInventoryMovementRepository implements InventoryMovementRepositoryInterface
{
    public function getAll(): Collection
    {
        return InventoryMovement::with(['product', 'movable'])->latest()->get();
    }

    public function findByProduct(int $productId): Collection
    {
        return InventoryMovement::where('product_id', $productId)->latest()->get();
    }

    public function create(array $data): InventoryMovement
    {
        return InventoryMovement::create($data);
    }
}