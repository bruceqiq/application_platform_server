<?php
declare(strict_types=1);

namespace App\Libs\Cloud\Handler;

use App\Libs\Cloud\CloudInterface;
use Qiniu\Auth;

/**
 * 七牛云
 * Class CloudQiNiu
 * @package App\Libs\Cloud
 */
class CloudQiNiu implements CloudInterface
{
    public function createToken(string $appId, string $appSecret, string $bucket): string
    {
        try {
            echo $appId . PHP_EOL . $appSecret . PHP_EOL;
            $auth  = new Auth($appId, $appSecret);
            $token = $auth->uploadToken($bucket);
            echo '获取的token是' . $token . PHP_EOL;
            return $token;
        } catch (\Exception $exception) {
            return '';
        }
    }
}