<?php

namespace App\Contracts;

use App\Models\TaxCondition;
use Illuminate\Support\Collection;

interface TaxConditionRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): TaxCondition;
    public function create(array $data): TaxCondition;
    public function update(int $id, array $data): TaxCondition;
    public function delete(int $id): bool;
}
