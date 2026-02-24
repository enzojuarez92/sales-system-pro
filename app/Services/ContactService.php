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

    public function getAllContacts(): Collection { return $this->repository->getAll(); }
    
    public function getCustomers(): Collection { return $this->repository->getCustomers(); }

    public function getSuppliers(): Collection { return $this->repository->getSuppliers(); }

    public function getContactById(int $id): Contact { return $this->repository->findById($id); }

    public function createContact(ContactDTO $dto): Contact 
    {
        return $this->repository->create((array) $dto);
    }

    public function updateContact(int $id, ContactDTO $dto): Contact
    {
        return $this->repository->update($id, (array) $dto);
    }

    public function deleteContact(int $id): bool { return $this->repository->delete($id); }
}