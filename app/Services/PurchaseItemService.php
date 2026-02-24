<?php

namespace App\Services;

use App\Contracts\PurchaseItemRepositoryInterface;
use App\DTOs\PurchaseItemDTO;
use App\DTOs\InventoryMovementDTO;
use App\Models\Purchase;

class PurchaseItemService
{
    public function __construct(
        protected PurchaseItemRepositoryInterface $repository,
        protected InventoryMovementService $inventoryService
    ) {}

    public function createItem(PurchaseItemDTO $dto, string $status, int $userId)
    {
        $item = $this->repository->create((array) $dto);

        // 1. Impacta al stock (kardex)
        if ($status === 'received') {
            $this->inventoryService->registerMovement(new InventoryMovementDTO(
                product_id: $dto->product_id,
                user_id: $userId,
                quantity: $dto->quantity,
                stock_before: 0, 
                stock_after: 0,
                movable_id: $dto->purchase_id,
                movable_type: Purchase::class,
                concept: "Compra Item ID: " . $item->id
            ));
        }

        // 2. Actualizamos el precio de costo en el producto ✅
        $product = \App\Models\Product::find($dto->product_id);
        if ($product) {
            $product->update(['cost_price' => $dto->cost_price]);
        }

        return $item;
    }
}