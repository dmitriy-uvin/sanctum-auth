<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected function successResponse(
        array $data,
        string $message = "",
        int $code = JsonResponse::HTTP_OK
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse(
        int $code,
        string $message = "",
        $data = null
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
