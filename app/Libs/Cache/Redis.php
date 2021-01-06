<?php
declare(strict_types=1);

namespace App\Libs\Cache;

/**
 * Class Redis
 * @package App\Libs\Cache
 */
class Redis
{
    public $redis = null;

    public static $instance = null;

    private function __construct()
    {
        $redis = new \Redis();
        $redis->connect(config('redis.default.host'), config('redis.default.port'));
        if (!empty(config('redis.default.auth'))) {
            $redis->auth(config('redis.default.auth'));
        }
        $this->redis = $redis;
    }

    public static function getRedisInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __destruct()
    {
    }
}