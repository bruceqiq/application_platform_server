<?php

declare(strict_types=1);

use App\Exception\Handler\RequestExceptionHandler;
use App\Exception\Handler\RouteExceptionHandler;
use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;
use App\Exception\Handler\AppExceptionHandler;

return [
    'handler' => [
        'http' => [
            RouteExceptionHandler::class,
            RequestExceptionHandler::class,
            AppExceptionHandler::class,
        ],
    ],
];
