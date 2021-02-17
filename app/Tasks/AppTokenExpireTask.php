<?php


namespace App\Tasks;

use App\Services\Api\Token\TokenService;
use Hyperf\Crontab\Annotation\Crontab;
use Hyperf\Di\Annotation\Inject;

/**
 * 应用token过期自动刷新任务
 * @Crontab(name="flush_app_token",rule="* * * * * *",callback="flushToken")
 */
class AppTokenExpireTask
{

    /**
     * @Inject()
     * @var TokenService
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