<?php
declare(strict_types=1);

namespace App\Controller\Api\Cloud;

use App\Controller\BaseController;
use App\Libs\Cache\Redis;
use App\Request\Api\CloudKeyValidate;
use App\Services\Api\Cloud\CloudStorageService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 第三方对象存储token
 * Class QiNiuController
 * @Controller(prefix="cloud/qiniu")
 * @package App\Controller\Api\Cloud
 */
class QiNiuController extends BaseController
{
    /**
     * @Inject()
     * @var CloudStorageService
     */
    protected $cloudService;

    /**
     * @GetMapping(path="token")
     * @param CloudKeyValidate $validate
     * @return ResponseInterface
     */
    public function token(CloudKeyValidate $validate)
    {
        $key       = $this->request->input('key', '');
        $cacheInfo = (Redis::getRedisInstance())->redis->get($key);
        if ($cacheInfo) {
            $info = json_decode($cacheInfo, true);
            return $this->response->success((array)$info);
        } else {
            // 重新获取 token
            $bean = $this->cloudService->findCloud((array)['key' => $key]);
            if (!empty($bean)) {
                return $this->response->success((array)[
                    'key'         => $key,
                    'token'       => $bean['token'],
                    'expire_time' => $bean['expire_time'],
                ]);
            } else {
                return $this->response->error((array)[
                    'key'         => $key,
                    'token'       => '该key已被禁用或者被删除',
                    'expire_time' => '该key已被禁用或者被删除',
                ]);
            }
        }
    }
}