<?php

namespace App\Services;

use App\Contracts\TaxRepositoryInterface;
use App\DTOs\TaxDTO;
use App\Models\Tax;
use Illuminate\Support\Collection;

class TaxService
{
    public function __construct(
        protected TaxRepositoryInterface $repository
    ) {}

    public function getAllTaxes(): Collection
    {
        return $this->repository->getAll();
    }

    public function getTaxById(int $id): Tax
    {
        return $this->repository->findById($id);
    }

    public function createTax(TaxDTO $dto): Tax
    {
        // Aquí va la lógica de negocio
        return $this->repository->create([
            'name' => $dto->name,
            'percentage' => $dto->percentage
        ]);
    }
}
