<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Collection;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::whereNull('parent_id')
            ->with('children')
            ->get();
    }

    public function findById(int $id): Category
    {
        return Category::with('children')->findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): Category
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
