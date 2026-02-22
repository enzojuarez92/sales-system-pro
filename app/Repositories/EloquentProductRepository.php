<?php

namespace App\Repositories;

use App\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function getAll(): Collection
    {
        return Product::with(['category', 'tax'])->get();
    }

    public function findById(int $id): Product
    {
        return Product::with('category')->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
