<?php

namespace App\Contracts;

use App\Models\Invoice;
use Illuminate\Support\Collection;

interface InvoiceRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): Invoice;
    public function findById(int $id): Invoice;
}