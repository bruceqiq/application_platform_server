<?php
declare(strict_types=1);

namespace App\Exception\Handler;

use App\Constants\ErrorCode;
use App\Constants\HttpCode;
use App\Functions\HttpDataResponse;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * 路由异常
 * Class RouteExceptionHandler
 * @package App\Exception\Handler
 */
class RouteExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @Inject()
     * @var HttpDataResponse
     */
    protected $httpResponse;

    public function __construct(StdoutLoggerInterface $logger, FormatterInterface $formatter)
    {
        $this->logger    = $logger;
        $this->formatter = $formatter;
    }


    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->debug($this->formatter->format($throwable));

        $this->stopPropagation();

        return $this->httpResponse->response((int)ErrorCode::ROUTE_ERROR, (string)ErrorCode::getMessage(ErrorCode::ROUTE_ERROR), (array)[], (int)HttpCode::NO_AUTH);
    }


    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}