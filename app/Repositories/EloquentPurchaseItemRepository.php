<?php

namespace App\Repositories;

use App\Contracts\PurchaseItemRepositoryInterface;
use App\Models\PurchaseItem;
use Illuminate\Support\Collection;

class EloquentPurchaseItemRepository implements PurchaseItemRepositoryInterface
{
    public function create(array $data): PurchaseItem
    {
        return PurchaseItem::create($data);
    }

    public function getByPurchase(int $purchaseId): Collection
    {
        return PurchaseItem::where('purchase_id', $purchaseId)->with('product')->get();
    }
}