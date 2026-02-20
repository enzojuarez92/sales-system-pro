<?php

namespace App\Contracts;

use App\Models\Tax;
use Illuminate\Support\Collection;

interface TaxRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): Tax;
    public function create(array $data): Tax;
}