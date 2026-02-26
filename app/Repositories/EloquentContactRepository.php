<?php

namespace App\Repositories;

use App\Contracts\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Support\Collection;

class EloquentContactRepository implements ContactRepositoryInterface
{
    public function getAll(): Collection
    {
        return Contact::with('taxCondition')->get();
    }

    public function getCustomers(): Collection
    {
        return Contact::where('is_customer', true)->with('taxCondition')->get();
    }

    public function getSuppliers(): Collection
    {
        return Contact::where('is_supplier', true)->with('taxCondition')->get();
    }

    public function findById(int $id): Contact
    {
        return Contact::with('taxCondition')->findOrFail($id);
    }

    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    public function update(int $id, array $data): Contact
    {
        $contact = Contact::findOrFail($id);
        $contact->update($data);
        return $contact;
    }

    public function delete(int $id): bool
    {
        $contact = Contact::findOrFail($id);
        return $contact->delete();
    }

    public function getAccountStatus(int $id): Contact
    {
        return Contact::with(['invoices', 'payments'])
            ->findOrFail($id);
    }
}
