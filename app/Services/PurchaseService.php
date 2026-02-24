<?php

namespace App\Services;

use App\Contracts\PurchaseRepositoryInterface;
use App\DTOs\InventoryMovementDTO;
use App\DTOs\PurchaseDTO;
use App\DTOs\PurchaseItemDTO;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function __construct(
        protected PurchaseRepositoryInterface $repository,
        protected PurchaseItemService $itemService,
        protected InventoryMovementService $inventoryService
    ) {}

    public function getAllPurchases()
    {
        return $this->repository->getAll();
    }

    public function createPurchase(PurchaseDTO $dto): Purchase
    {
        return DB::transaction(function () use ($dto) {
            // 1. Crear Cabecera con el repo de Purchases
            $purchase = $this->repository->create([
                'contact_id'   => $dto->contact_id,
                'user_id'      => $dto->user_id,
                'number'       => $dto->number,
                'date'         => $dto->date,
                'status'       => $dto->status,
                'total_amount' => $dto->total_amount,
                'notes'        => $dto->notes,
            ]);

            // 2. Crear cada ítem usando el PurchaseItemService
            foreach ($dto->items as $itemData) {
                $itemDto = new PurchaseItemDTO(
                    purchase_id: $purchase->id,
                    product_id: $itemData['product_id'],
                    quantity: $itemData['quantity'],
                    cost_price: $itemData['cost_price'],
                    tax_amount: $itemData['tax_amount'] ?? 0,
                    subtotal: $itemData['subtotal']
                );

                $this->itemService->createItem($itemDto, $purchase->status, $dto->user_id);
            }

            return $purchase->load('items');
        });
    }

    public function getPurchaseById(int $id): Purchase
    {
        return $this->repository->findById($id);
    }

    public function cancelPurchase(int $id, int $userId): Purchase
    {
        return DB::transaction(function () use ($id, $userId) {
            $purchase = $this->repository->findById($id);

            if ($purchase->status === 'cancelled') {
                throw new \Exception("Esta compra ya está anulada.");
            }

            // Si estaba recibida, hay que sacar del stock lo que entró
            if ($purchase->status === 'received') {
                foreach ($purchase->items as $item) {
                    $this->inventoryService->registerMovement(new InventoryMovementDTO(
                        product_id: $item->product_id,
                        user_id: $userId,
                        quantity: -$item->quantity, // Restamos la cantidad que había entrado
                        stock_before: 0,
                        stock_after: 0,
                        movable_id: $purchase->id,
                        movable_type: Purchase::class,
                        concept: "ANULACIÓN de Compra Nro: " . ($purchase->number ?? $purchase->id)
                    ));
                }
            }

            // Cambiamos el estado a cancelado
            $purchase->update(['status' => 'cancelled']);

            return $purchase;
        });
    }
}
