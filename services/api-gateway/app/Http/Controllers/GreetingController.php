<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    /**
     * Возвращает приветственное сообщение
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->jsonToResponse([
            'message' => 'Привет! Добро пожаловать в API Gateway',
            'status' => 'success',
            'timestamp' => date('c'),
        ], 200);
    }
}

