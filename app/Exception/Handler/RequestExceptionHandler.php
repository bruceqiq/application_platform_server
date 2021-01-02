<?php

namespace App\Exception\Handler;

use App\Functions\HttpDataResponse;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class RequestExceptionHandler extends ExceptionHandler
{
    /**
     * @Inject()
     * @var HttpDataResponse
     */
    protected $httpResponse;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var \Hyperf\Validation\ValidationException $throwable */
        $body = $throwable->validator->errors()->first();
        return $this->httpResponse->response((int)1001, (string)$body, (array)[], (int)422);
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}