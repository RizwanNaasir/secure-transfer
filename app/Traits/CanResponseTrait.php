<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait CanResponseTrait
{
    protected function success(
        mixed  $data = null,
        string $message = 'success',
        int    $code = 200
    ): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(
        mixed  $data = null,
        string $message = 'error',
        int    $code = Response::HTTP_BAD_REQUEST
    ): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function notFound(
        mixed  $data = null,
        string $message = 'not found',
        int    $code = Response::HTTP_NOT_FOUND
    ): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
