<?php

namespace App\Services;

use App\Contracts\ContactRepositoryInterface;
use App\DTOs\ContactDTO;
use App\Models\Contact;
use Illuminate\Support\Collection;

class ContactService
{
    public function __construct(
        protected ContactRepositoryInterface $repository
    ) {}

    public function getAllContacts(): Collection
    {
        return $this->repository->getAll();
    }

    public function getCustomers(): Collection
    {
        return $this->repository->getCustomers();
    }

    public function getSuppliers(): Collection
    {
        return $this->repository->getSuppliers();
    }

    public function getContactById(int $id): Contact
    {
        return $this->repository->findById($id);
    }

    public function createContact(ContactDTO $dto): Contact
    {
        return $this->repository->create((array) $dto);
    }

    public function updateContact(int $id, ContactDTO $dto): Contact
    {
        return $this->repository->update($id, (array) $dto);
    }

    public function deleteContact(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getAccountStatus(int $id): array
    {
        $contact = $this->repository->getAccountStatus($id);

        return [
            'contact_id'   => $contact->id,
            'contact_name' => $contact->name,
            'balance'      => (float) $contact->balance, 
            'total_invoiced' => (float) $contact->invoices->sum('total_amount'),
            'total_paid'     => (float) $contact->payments->sum('amount'),
            'history' => collect()
                ->concat($contact->invoices->map(fn($i) => [
                    'date' => $i->date,
                    'type' => 'Factura',
                    'number' => $i->number,
                    'amount' => (float) $i->total_amount,
                    'description' => "Venta comprobante {$i->number}"
                ]))
                ->concat($contact->payments->map(fn($p) => [
                    'date' => $p->date,
                    'type' => 'Pago',
                    'number' => $p->id,
                    'amount' => (float) $p->amount * -1,
                    'description' => "Cobro: {$p->reference}"
                ]))
                ->sortBy('date')
                ->values()
                ->all()
        ];
    }
}
