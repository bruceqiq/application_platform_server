<?php
declare(strict_types=1);

namespace App\Functions;

use App\Constants\ErrorCode;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * 响应数据格式
 * Class HttpDataResponse
 * @package App\Functions
 */
class HttpDataResponse
{
    /**
     * @Inject()
     * @var ResponseInterface
     */
    protected $response;

    /**
     * 成功时返回数据格式
     * @param array $data 业务数据
     * @param int $code 业务状态码
     * @param string $message 业务状态信息
     * @param int $httpCode 网络状态码
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function success(array $data = [], int $code = 0, string $message = '', int $httpCode = 200): \Psr\Http\Message\ResponseInterface
    {
        return $this->response->json([
            'code'    => empty($code) ? ErrorCode::REQUEST_SUCCESS : $code,
            'message' => empty($message) ? ErrorCode::getMessage(ErrorCode::REQUEST_SUCCESS) : $message,
            'data'    => $data
        ])->withStatus((int)$httpCode);
    }

    /**
     * 失败时返回数据格式
     * @param int $code 业务状态码
     * @param string $message 业务状态信息
     * @param array $data 业务数据
     * @param int $httpCode 网络状态码
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function error(array $data = [], int $code = 0, string $message = '', int $httpCode = 200): \Psr\Http\Message\ResponseInterface
    {
        return $this->response->json([
            'code'    => empty($code) ? ErrorCode::REQUEST_ERROR : $code,
            'message' => empty($message) ? ErrorCode::getMessage(ErrorCode::REQUEST_ERROR) : $message,
            'data'    => $data
        ])->withStatus((int)$httpCode);
    }

    /**
     * 自定义返回数据格式
     * @param int $code 业务状态码
     * @param string $message 业务状态信息
     * @param array $data 业务数据
     * @param int $httpCode 网络请求状态码
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function response(int $code, string $message, array $data, int $httpCode = 500): \Psr\Http\Message\ResponseInterface
    {
        return $this->response->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        ])->withStatus((int)$httpCode);
    }
}