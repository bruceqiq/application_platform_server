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
    public static function deleteRedisCacheByWhere(array $cacheKeysArray): bool
    {
        var_dump('删除key', $cacheKeysArray);
        $numbers = (Redis::getRedisInstance())->redis->del($cacheKeysArray);
        var_dump('删除token数量', $numbers);
        return $numbers ? true : false;
    }
}