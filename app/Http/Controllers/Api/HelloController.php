<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HelloController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Hello from Laravel API',
            'data' => [
                'framework' => 'Laravel',
                'version' => app()->version(),
            ],
        ]);
    }
}