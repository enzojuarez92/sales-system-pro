<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products, 200);
    }

    public function show(Product $Product)
    {
        $Product = $this->productService->getProductById($Product->id);
        return response()->json($Product, 200);
    }

    public function store(ProductRequest $request)
    {
        $dto = ProductDTO::fromRequest($request->validated());

        $product = $this->productService->createProduct(
            $dto,
            $request->file('image')
        );

        return response($product, 201);
    }

    public function update(ProductRequest $request, Product $Product)
    {
        $dto = ProductDTO::fromRequest($request->validated());
        $Product = $this->productService->updateProduct(
            $Product->id,
            $dto,
            $request->file('image')
        );

        return response()->json($Product, 201);
    }

    public function destroy(int $id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(null, 204);
    }
}
