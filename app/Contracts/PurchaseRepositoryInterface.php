<?php

namespace App\Contracts;

use App\Models\Purchase;
use Illuminate\Support\Collection;

interface PurchaseRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): Purchase;
    public function findById(int $id): Purchase;
}