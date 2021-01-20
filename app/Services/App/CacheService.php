<?php
declare(strict_types=1);

namespace App\Services\App;

use App\Libs\Cache\Redis;

/**
 * Class CacheService
 * @package App\Services\App
 */
class CacheService
{
    /**
     * 删除redis指定内容
     * @param array $cacheKeysArray
     * @return bool
     * @author kert
     */
    public static function deleteRedisCacheByWhere(array $cacheKeysArray): bool
    {
        $numbers = (Redis::getRedisInstance())->redis->del($cacheKeysArray);
        return $numbers ? true : false;
    }
}