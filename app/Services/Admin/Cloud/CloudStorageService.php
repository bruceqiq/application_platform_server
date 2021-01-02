<?php
declare(strict_types=1);

namespace App\Services\Admin\Cloud;

use App\Libs\Cache\Redis;
use App\Libs\Cloud\CloudLib;
use App\Repositories\Admin\Cloud\CloudStorageRepositories;

/**
 * 云服务存储
 * Class CloudService
 * @package App\Services\Admin\Cloud
 */
class CloudStorageService
{
    private $cloudRepositories;

    public function __construct()
    {
        $this->cloudRepositories = new CloudStorageRepositories;
    }

    public function cloudSelect(array $requestParams): array
    {
        $perSize     = $requestParams['size'] ?? 20;
        $searchWhere = [];
        if (!empty($requestParams['name'])) {
            array_push($searchWhere, ['name', 'like', '%' . $requestParams['name'] . '%']);
        }
        return $this->cloudRepositories->cloudSelect((array)$searchWhere, (int)$perSize);
    }

    public function cloudStore(array $requestParams): bool
    {
        $info = $this->dataFormatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        if ($info['code']) {
            if ($this->cloudRepositories->cloudStore((array)$info)) {
                return true;
            }
            (Redis::getRedisInstance())->redis->delete($info['key']);
            return false;
        }
        return false;
    }

    public function cloudUpdate(array $requestParams): bool
    {
        $info = $this->dataFormatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        if ($info['code']) {
            unset($info['key']);
            unset($info['code']);
            return $this->cloudRepositories->cloudUpdate((array)$info, (int)$requestParams['id']);
        }
        return false;
    }

    public function cloudDelete(array $requestParams): bool
    {
        return $this->cloudRepositories->cloudDelete((array)[['id', '=', $requestParams['id']]]);
    }

    private function createToken(array $info): array
    {
        $createToken         = CloudLib::createToken((int)$info['cloud_platform_id'], (array)$info);
        $info['code']        = $createToken['code'];
        $info['token']       = $createToken['token'];
        $info['expire_time'] = $createToken['expire_time'];

        return $info;
    }

    private function dataFormatter(array $requestParams): array
    {
        return [
            'cloud_platform_id' => $requestParams['cloud_platform_id'],
            'key'               => $requestParams['key'] ?? (md5((string)time())),
            'app_id'            => trim($requestParams['app_id']),
            'app_secret'        => trim($requestParams['app_secret']),
            'name'              => $requestParams['name'],
            'region'            => trim($requestParams['region']),
            'bucket'            => trim($requestParams['bucket']),
            'domain'            => trim($requestParams['domain']),
            'remark'            => $requestParams['remark'] ?? '',
            'token'             => '',
            'expire_time'       => date('Y-m-d H:i:s'),
            'id'                => $requestParams['id'] ?? 0,
        ];
    }
}