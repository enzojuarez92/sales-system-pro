<?php

namespace App\Repositories;

use App\Contracts\PurchaseRepositoryInterface;
use App\Models\Purchase;
use Illuminate\Support\Collection;

class EloquentPurchaseRepository implements PurchaseRepositoryInterface
{
    public function getAll(): Collection
    {
        return Purchase::with(['contact','items'])->get();
    }

    public function create(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function findById(int $id): Purchase
    {
        return Purchase::with(['contact','items'])->findOrFail($id);
    }
} 