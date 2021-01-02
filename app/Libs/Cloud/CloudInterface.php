<?php
declare(strict_types=1);

namespace App\Libs\Cloud;

/**
 * 对象存储接口
 * Class CloudInterface
 * @package App\Libs\Cloud
 */
Interface CloudInterface
{
    public function createToken(string $appId, string $appSecret, string $bucket);
}