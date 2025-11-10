<?php

use App\Http\Controllers\LogController;
use Illuminate\Routing\Router;

return function (Router $router) {
    $router->post('/api/log', [LogController::class, 'log']);
};

