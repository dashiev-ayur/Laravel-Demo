<?php

namespace Shared;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * Создает JsonResponse с правильной кодировкой UTF-8 и заголовками
     *
     * @param array|object $data Данные для JSON ответа
     * @param int $status HTTP статус код (обязательный)
     * @return JsonResponse
     */
    protected function jsonToResponse($data, int $status): JsonResponse
    {
        $response = new JsonResponse($data, $status);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $response->header('Content-Type', 'application/json; charset=utf-8');
        
        return $response;
    }
}

