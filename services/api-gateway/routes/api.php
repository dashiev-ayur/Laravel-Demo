<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\LoggingTestController;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

return function (Router $router) {
    $router->get('/api/greeting', [GreetingController::class, 'index']);
    $router->get('/api/health', [HealthController::class, 'index']);
    $router->post('/api/test-logging', [LoggingTestController::class, 'test']);
};

