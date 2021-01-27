<?php

declare(strict_types=1);

use App\Exception\Handler\RequestExceptionHandler;
use App\Exception\Handler\AppExceptionHandler;

return [
    'handler' => [
        'http' => [
            RequestExceptionHandler::class,
            AppExceptionHandler::class,
        ],
    ],
];
