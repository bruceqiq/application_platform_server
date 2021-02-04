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
    /**
     * 生成七牛云存储token
     * @param string $appId
     * @param string $appSecret
     * @param string $bucket
     * @return string
     * @author ert
     */
    public function createToken(string $appId, string $appSecret, string $bucket): string
    {
        try {
            $auth  = new Auth($appId, $appSecret);
            $token = $auth->uploadToken($bucket);
            return $token;
        } catch (\Exception $exception) {
            return '';
        }
    }
}