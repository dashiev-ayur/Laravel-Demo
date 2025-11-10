<?php

// Устанавливаем кодировку UTF-8
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

require_once __DIR__.'/../vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$container = new Container();
$request = Request::capture();
$events = new Dispatcher($container);
$router = new Router($events, $container);

// Настройка контейнера для разрешения зависимостей
$router->middleware([]);

// Регистрация маршрутов
$routes = require_once __DIR__.'/../routes/api.php';
$routes($router);

try {
    $response = $router->dispatch($request);
    $response->send();
} catch (\Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

