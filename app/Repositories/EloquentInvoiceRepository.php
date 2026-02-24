<?php

namespace App\Repositories;

use App\Contracts\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Collection;

class EloquentInvoiceRepository implements InvoiceRepositoryInterface
{
    public function getAll(): Collection
    {
        return Invoice::with(['contact', 'user', 'items.product'])->latest()->get();
    }

    public function create(array $data): Invoice
    {
        return Invoice::create($data);
    }

    public function findById(int $id): Invoice
    {
        return Invoice::with(['contact', 'user', 'items.product'])->findOrFail($id);
    }
}