<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiBadRequestException extends BadRequestHttpException
{
    use ApiResponser;

    public function render(): JsonResponse
    {
        return $this->errorResponse(
            message: $this->getMessage(),
            statusCode: Response::HTTP_BAD_REQUEST
        );
    }
}
