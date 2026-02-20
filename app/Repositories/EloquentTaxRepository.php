<?php

namespace App\Repositories;

use App\Models\Tax;
use App\Contracts\TaxRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentTaxRepository implements TaxRepositoryInterface
{
    public function getAll(): Collection
    {
        return Tax::all();
    }

    public function findById(int $id): Tax
    {
        return Tax::findOrFail($id);
    }

    public function create(array $data): Tax
    {
        return Tax::create($data);
    }
}
