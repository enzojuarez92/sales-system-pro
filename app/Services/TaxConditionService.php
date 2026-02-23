<?php

namespace App\Services;

use App\Contracts\TaxConditionRepositoryInterface;
use App\DTOs\TaxConditionDTO;
use App\Models\TaxCondition;
use Illuminate\Support\Collection;

class TaxConditionService
{
    public function __construct(
        protected TaxConditionRepositoryInterface $repository
    ){}

    public function getAllTaxConditions(): Collection
    {
        return $this->repository->getAll();
    }

    public function getTaxConditionById(int $id): TaxCondition
    {
        return $this->repository->findById($id);
    }

    public function createTaxCondition(TaxConditionDTO $dto): TaxCondition
    {
        return $this->repository->create((array) $dto);
    }

    public function updateTaxCondition(int $id, TaxConditionDTO $dto): TaxCondition
    {
        return $this->repository->update($id, (array) $dto);
    }

    public function deleteTaxCondition(int $id): bool{
        return $this->repository->delete($id);
    }
}
