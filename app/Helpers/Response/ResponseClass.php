<?php
use Illuminate\Http\JsonResponse;

if(!function_exists('SuccessResponse')) {
    function SuccessResponse(string $message, array|object $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => empty($data) ? null : $data,
        ], $code);
    }
}

if(!function_exists('ErrorResponse')) {
    function ErrorResponse(int $code, string $message, array|object $data = null) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => empty($data) ? null : $data,
        ], $code);
    }
}
