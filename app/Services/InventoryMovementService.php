<?php

namespace App\Services;

use App\Contracts\InventoryMovementRepositoryInterface;
use App\DTOs\InventoryMovementDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InventoryMovementService
{
    public function __construct(
        protected InventoryMovementRepositoryInterface $repository
    ) {}

    public function registerMovement(InventoryMovementDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $product = Product::lockForUpdate()->findOrFail($dto->product_id);

            // VALIDACIÓN CRÍTICA DE STOCK
            if ($dto->quantity < 0) { 
                $requestedQuantity = abs($dto->quantity);
                if ($product->stock < $requestedQuantity) {
                    throw new \Exception("Stock insuficiente para '{$product->name}'. Disponible: {$product->stock}, Solicitado: {$requestedQuantity}");
                }
            }

            $stockBefore = $product->stock;
            $stockAfter = $stockBefore + $dto->quantity;

            $movementData = (array) $dto;
            $movementData['stock_before'] = $stockBefore;
            $movementData['stock_after'] = $stockAfter;

            $movement = $this->repository->create($movementData);

            $product->update(['stock' => $stockAfter]);

            return $movement;
        });
    }
}
