<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LoggingTestController extends Controller
{
    /**
     * Тестирует микросервис логирования
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function test(Request $request): JsonResponse
    {
        $message = $request->input('message', 'Test message from API Gateway');
        $level = $request->input('level', 'info');
        
        // URL микросервиса логирования (можно настроить через переменные окружения)
        $loggingServiceUrl = getenv('LOGGING_SERVICE_URL') ?: 'http://localhost:8001';
        
        try {
            $client = new Client([
                'timeout' => 5.0,
            ]);
            
            $response = $client->post($loggingServiceUrl . '/api/log', [
                'json' => [
                    'message' => $message,
                    'level' => $level,
                ],
            ]);
            
            $result = json_decode($response->getBody()->getContents(), true);
            
            return $this->jsonToResponse([
                'status' => 'success',
                'message' => 'Logging service called successfully',
                'logging_service_response' => $result,
            ], 200);
            
        } catch (GuzzleException $e) {
            return $this->jsonToResponse([
                'status' => 'error',
                'message' => 'Failed to connect to logging service',
                'error' => $e->getMessage(),
                'logging_service_url' => $loggingServiceUrl,
            ], 500);
        } catch (\Exception $e) {
            return $this->jsonToResponse([
                'status' => 'error',
                'message' => 'Unexpected error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

