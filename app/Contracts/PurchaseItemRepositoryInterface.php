<?php

namespace App\Contracts;

use App\Models\PurchaseItem;
use Illuminate\Support\Collection;

interface PurchaseItemRepositoryInterface
{
    public function create(array $data): PurchaseItem;
    public function getByPurchase(int $purchaseId): Collection;
}