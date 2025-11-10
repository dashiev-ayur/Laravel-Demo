<?php

return [
    'name' => env('APP_NAME', 'API Gateway'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'UTC',
    'locale' => 'ru',
    'fallback_locale' => 'en',
    'providers' => [
        Illuminate\Routing\RoutingServiceProvider::class,
        Illuminate\Http\Request::class,
    ],
];

