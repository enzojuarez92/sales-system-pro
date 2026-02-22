<?php

namespace App\Services;

use App\Contracts\ProductRepositoryInterface;
use App\DTOs\ProductDTO;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function getAllProducts(): Collection
    {
        return $this->repository->getAll();
    }

    public function getProductById(int $id): Product
    {
        return $this->repository->findById($id);
    }

    public function createProduct(ProductDTO $dto, $image = null): Product
    {
        $data = (array) $dto;

        if ($image) {
            $data['image_path'] = $image->store('products', 'public');
        }

        $data['slug'] = Str::slug($data['name']);

        return $this->repository->create($data);
    }

    public function updateProduct(int $id, ProductDTO $dto, $image = null): Product
    {
        $product = $this->repository->findById($id);
        $data = (array) $dto;

        if ($image) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $image->store('products', 'public');
        }

        return $this->repository->update($id, $data);
    }

    public function deleteProduct(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
