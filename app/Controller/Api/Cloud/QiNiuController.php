<?php
declare(strict_types=1);

namespace App\Controller\Api\Cloud;

use App\Controller\BaseController;
use App\Libs\Cache\Redis;
use App\Libs\Guzzle\Guzzle;
use App\Request\Api\KeyValidate;
use App\Services\Api\Cloud\CloudStorageService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 七牛云
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
     * @Inject()
     * @var Guzzle
     */
    protected $guzzleLib;

    /**
     * @GetMapping(path="token")
     * @param KeyValidate $validate
     * @return ResponseInterface
     */
    public function token(KeyValidate $validate)
    {
        $key       = $this->request->input('key', '');
        $cacheInfo = (Redis::getRedisInstance())->redis->get($key);
        if ($cacheInfo) {
            $info = json_decode($cacheInfo, true);
            return $this->response->success((array)$info);
        } else {
            // 重新获取 token
            $bean = $this->cloudService->findCloud((array)['key' => $key]);
            return $this->response->success((array)[
                'key'         => $key,
                'token'       => $bean['token'],
                'expire_time' => $bean['expire_time'],
            ]);
        }
    }

    /**
     * @GetMapping(path="show")
     */
    public function show()
    {
        $this->guzzleLib->getRequest((string)'https://yuanlinhui.yiputouzi.com/admin/common/qn/upload/token', (array)['key' => 'e82f3283ebeb40b3fe2f247be5e8ec61']);
    }
}