<?php
declare(strict_types=1);

namespace App\Controller\Api\Token;


use App\Controller\BaseController;
use App\Libs\Cache\Redis;
use App\Request\Api\TokenKeyValidate;
use App\Services\Api\Token\TokenService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * Class TokenController
 * @Controller(prefix="app/token")
 * @package App\Controller\Api\Token
 */
class TokenController extends BaseController
{
    /**
     * @Inject()
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @GetMapping(path="get")
     * @GetMapping(path="token")
     * @param TokenKeyValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function token(TokenKeyValidate $validate)
    {
        $key       = $this->request->input('key', '');
        $cacheInfo = (Redis::getRedisInstance())->redis->get($key);
        if ($cacheInfo) {
            $info = json_decode($cacheInfo, true);
            return $this->response->success((array)$info);
        } else {
            // 重新获取 token
            $bean = $this->tokenService->findCloud((array)['key' => $key]);
            return $this->response->success((array)[
                'key'         => $key,
                'token'       => $bean['token'] ?? '该key已被禁用或者被删除',
                'expire_time' => $bean['expire_time'] ?? '该key已被禁用或者被删除',
            ]);
        }
    }
}