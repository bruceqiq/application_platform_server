<?php
declare(strict_types=1);

namespace App\Libs\Cloud\Handler;

use App\Libs\Cloud\CloudInterface;

/**
 * 阿里云
 * Class AliCloud
 * @package App\Libs\Cloud
 */
class CloudAli implements CloudInterface
{
    public function createToken(string $appId, string $appSecret, string $bucket): string
    {
        return $appId;
        // TODO: Implement createToken() method.
    }
}