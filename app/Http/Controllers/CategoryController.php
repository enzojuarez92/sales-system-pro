<?php

namespace App\Http\Controllers;

use App\DTOs\CategoryDTO;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    )
    {
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json($categories,201);
    }

    public function show(Category $category){
        $category = $this->categoryService->getCategoryById($category->id);
        return response()->json($category,201);
    }

    public function store(CategoryRequest $request){
        $dto = CategoryDTO::fromRequest($request->validated());
        $category = $this->categoryService->createCategory($dto);

        return response($category, 201);
    }

    public function update(CategoryRequest $request, Category $category){
        $dto = CategoryDTO::fromRequest($request->validated());
        $category = $this->categoryService->updateCategory($category->id, $dto);

        return response()->json($category,201);
    }
}
