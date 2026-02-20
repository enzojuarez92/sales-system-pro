<?php

namespace App\Services;

use App\Contracts\CategoryRepositoryInterface;
use App\DTOs\CategoryDTO;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $repository
    ) {}

    public function getAllCategories(): Collection
    {
        return $this->repository->getAll();
    }

    public function getCategoryById(int $id): Category
    {
        return $this->repository->findById($id);
    }

    public function createCategory(CategoryDTO $dto): Category
    {
        return $this->repository->create([
            'name' => $dto->name,
            'description' => $dto->description
        ]);
    }

    public function updateCategory(int $id, CategoryDTO $dto): Category
    {        return $this->repository->update($id, [
            'name' => $dto->name,
            'description' => $dto->description
        ]);
    }
}
