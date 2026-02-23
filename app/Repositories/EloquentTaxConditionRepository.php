<?php

namespace App\Repositories;

use App\Contracts\TaxConditionRepositoryInterface;
use App\Models\TaxCondition;
use Illuminate\Support\Collection;

class EloquentTaxConditionRepository implements TaxConditionRepositoryInterface
{
    public function getAll(): Collection
    {
        return TaxCondition::all(); //with('contacts')->get();
    }

    public function findById(int $id): TaxCondition
    {
        return TaxCondition::findOrFail($id); //with('contacts')->findOrFail($id);
    }

    public function create(array $data): TaxCondition
    {
        return TaxCondition::create($data);
    }

    public function update(int $id, array $data): TaxCondition
    {
        $tax_condition = TaxCondition::findOrFail($id);
        $tax_condition->update($data);
        return $tax_condition;
    }

    public function delete(int $id): bool
    {
        $tax_condition = TaxCondition::findOrFail($id);
        return $tax_condition->delete();
    }
}
