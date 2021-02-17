<?php


namespace App\Tasks;

use App\Services\Api\Cloud\CloudStorageService;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

/**
 * 应用token过期自动刷新任务
 * @Crontab(name="flush_cloud_token",rule="*\/60 * * * * *",callback="flushToken")
 */
class CloudTokenExpireTask
{

    /**
     * @Inject()
     * @var CloudStorageService
     */
    protected $tokenService;

    public function flushToken()
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $items           = $this->tokenService->select((array)['expire_time' => $currentDateTime]);

        foreach ($items['items'] as $value) {
            $this->tokenService->findCloud((array)['key' => $value['key']]);
        }
    }
}