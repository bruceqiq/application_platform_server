<?php
declare(strict_types=1);

namespace App\Libs\Cloud;

use App\Libs\Cache\Redis;
use App\Libs\Cloud\Handler\CloudQiNiu;

/**
 * 对象存储依赖库
 * Class CloudLib
 * @package App\Libs\Cloud
 */
class CloudLib
{
    public function __construct()
    {
    }

    /**
     * 创建云存储Token
     * @param int $platformId
     * @param array $cloudInfo ['app_id', 'app_secret', 'bucket', 'key', 'cloud_platform_id']
     * @return array ['token', 'expire_time']
     */
    public static function createToken(int $platformId, array $cloudInfo): array
    {
        $dateTime    = date('Y-m-d H:i:s', time() + 7200);
        $returnArray = [
            'code'        => 0,
            'token'       => '',
            'expire_time' => $dateTime,
        ];
        switch ($platformId) {
            case 1:
                $returnArray['token'] = (new CloudQiNiu())->createToken(
                    (string)$cloudInfo['app_id'],
                    (string)$cloudInfo['app_secret'],
                    (string)$cloudInfo['bucket']);
                break;
        }
        if (!empty($returnArray['token'])) {
            $cacheInfo = json_encode(['key' => $cloudInfo['key'], 'expire_time' => $dateTime, 'token' => $returnArray['token']]);
            if ((Redis::getRedisInstance())->redis->set($cloudInfo['key'], $cacheInfo, 7200)) {
                $returnArray['code'] = 1;
            }
        }

        return $returnArray;
    }
}