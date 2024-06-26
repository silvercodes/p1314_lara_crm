<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function get(Category $category): JsonResponse
    {
        return $this->successResponse($category->toArray());
    }

    public function index(): JsonResponse
    {
        return $this->successResponse(Category::all()->toArray());
    }

    public function store(CreateCategoryRequest $request)
    {
        dd($request->validated());
    }
}
