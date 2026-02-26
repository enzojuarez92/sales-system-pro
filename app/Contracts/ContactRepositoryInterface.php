<?php 

namespace App\Contracts;

use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function getAll(): Collection;
    public function getCustomers(): Collection;
    public function getSuppliers(): Collection;
    public function findById(int $id): Contact;
    public function create(array $data): Contact;
    public function update(int $id, array $data): Contact;
    public function delete(int $id): bool;
    public function getAccountStatus(int $id): Contact;
}