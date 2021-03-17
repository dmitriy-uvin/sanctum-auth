<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success(
        $data,
        string $message = null,
        int $code = JsonResponse::HTTP_OK
    ): JsonResponse {

    }

    protected function error(
        int $code,
        string $message = null,
        $data = null
    ): JsonResponse {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
