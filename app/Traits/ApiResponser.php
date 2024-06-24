<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    protected function successResponse(
        array $data = [],
        string $message = null,
        int $statusCode = 200
    ): JsonResponse {
        return response()->json([
            'ok' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function errorResponse(
        string $message,
        int $statusCode,
        array $errors = []
    ): JsonResponse {
        return response()->json([
            'ok' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}