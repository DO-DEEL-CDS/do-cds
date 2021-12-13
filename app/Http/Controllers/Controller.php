<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
        ], $status);
    }

    public function error(string $message = 'Invalid Request', int $status = 400): JsonResponse
    {
        return response()->json([
                'error' => [
                        'message' => $message,
                        'code' => $status
                ]
        ], $status);
    }
}
