<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\PatchCategoryRequest;
use App\Http\Requests\Category\PutCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 *  Controller for category resource
 */
class CategoryController extends Controller
{
    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function get(Category $category): JsonResponse
    {
        return $this->successResponse($category->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(Category::all()->toArray());
    }

    /**
     * @param CreateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return $this->successResponse(
            data: $category->toArray(),
            statusCode: Response::HTTP_CREATED
        );
    }

    /**
     * @param Category $category
     * @param PatchCategoryRequest $request
     * @return JsonResponse
     */
    public function patch(Category $category, PatchCategoryRequest $request): JsonResponse
    {
        $category->update($request->validated());

        return $this->successResponse(
            statusCode: Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @param Category $category
     * @param PutCategoryRequest $request
     * @return JsonResponse
     */
    public function put(Category $category, PutCategoryRequest $request): JsonResponse
    {
        $category->update($request->validated());

        return $this->successResponse(
            statusCode: Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Category $category): JsonResponse
    {
        $category->delete();

        return $this->successResponse(
            statusCode: Response::HTTP_NO_CONTENT
        );
    }
}
