<?php
declare(strict_types=1);

namespace App\Libs\Cloud\Handler;

use App\Libs\Cloud\CloudInterface;

/**
 * 腾讯云
 * Class CloudTenCent
 * @package App\Libs\Cloud
 */
class CloudTenCent implements CloudInterface
{
    public function createToken(string $appId, string $appSecret, string $bucket): string
    {
        return $appId;
        // TODO: Implement createToken() method.
    }
}