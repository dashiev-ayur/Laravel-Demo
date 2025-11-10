<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Логирует сообщение в консоль
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function log(Request $request): JsonResponse
    {
        // Получаем данные из JSON body
        $content = $request->getContent();
        $data = [];
        
        if (!empty($content)) {
            $data = json_decode($content, true) ?? [];
        }
        
        // Если JSON не распарсился, пробуем получить через input
        if (empty($data)) {
            $data = $request->all();
        }
        
        $message = $data['message'] ?? $request->input('message', '');
        $level = $data['level'] ?? $request->input('level', 'info');
        
        if (empty($message)) {
            return $this->jsonToResponse([
                'error' => 'Message is required',
                'status' => 'error',
            ], 400);
        }
        
        // Логирование в консоль
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
        
        // Вывод в консоль (stdout)
        error_log($logMessage, 4); // 4 = SAPI error log handler
        
        // Также выводим в stdout для Docker контейнеров
        file_put_contents('php://stdout', $logMessage);
        
        return $this->jsonToResponse([
            'status' => 'success',
            'message' => 'Message logged successfully',
            'logged_message' => $message,
            'level' => $level,
            'timestamp' => $timestamp,
        ], 200);
    }
}

