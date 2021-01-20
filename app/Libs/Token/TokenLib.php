<?php
declare(strict_types=1);

namespace App\Libs\Token;

use App\Libs\Cache\Redis;
use App\Libs\Token\Handler\TokenWeChatPublic;

/**
 * token
 * Class TokenLib
 * @package App\Libs\Token
 */
class TokenLib
{
    /**
     * 创建第三方存储Token
     * @param int $platformId
     * @param array $cloudInfo ['app_id', 'app_secret', 'key', 'cloud_platform_id', 'cache_time']
     * @param array $cloudInfo ['app_id', 'app_secret', 'key', 'cloud_platform_id']
     * @return array ['token', 'expire_time']
     */
    public static function createToken(int $platformId, array $cloudInfo): array
    {
        $dateTime    = date('Y-m-d H:i:s', time() + $cloudInfo['cache_time']);
        $returnArray = ['code' => 0, 'token' => '', 'expire_time' => $dateTime,];
        switch ($platformId) {
            case 4:
                $returnArray['token'] = (new TokenWeChatPublic())->createToken(
                    (string)$cloudInfo['app_id'],
                    (string)$cloudInfo['app_secret']);
                break;
            default:
        }
        if (!empty($returnArray['token'])) {
            $cacheInfo = json_encode(['key' => $cloudInfo['key'], 'expire_time' => $dateTime, 'token' => $returnArray['token']]);
            (Redis::getRedisInstance())->redis->set($cloudInfo['key'], $cacheInfo);
            if ((Redis::getRedisInstance())->redis->set($cloudInfo['key'], $cacheInfo, (int)$cloudInfo['cache_time'])) {
                $returnArray['code'] = 1;
            }
        }
        return $returnArray;
    }
}