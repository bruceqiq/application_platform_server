<?php

declare(strict_types=1);

use App\Exception\Handler\RequestExceptionHandler;
use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;
use App\Exception\Handler\AppExceptionHandler;

return [
    'handler' => [
        'http' => [
            RequestExceptionHandler::class,
            HttpExceptionHandler::class,
            AppExceptionHandler::class,
        ],
    ],
];
