<?php
declare(strict_types=1);

namespace App\Services\Admin\Cloud;

use App\Libs\Cache\Redis;
use App\Libs\Cloud\CloudLib;
use App\Repositories\Admin\Cloud\CloudStorageRepository;
use App\Services\App\CacheService;
use Hyperf\Di\Annotation\Inject;

/**
 * Class CloudService
 * @package App\Services\Admin\Cloud
 */
class CloudStorageService
{
    /**
     * @Inject()
     * @var CloudStorageRepository
     */
    private $cloudRepository;

    public function cloudSelect(array $requestParams): array
    {
        $perSize     = $requestParams['size'] ?? 20;
        $searchWhere = [];
        if (!empty($requestParams['name'])) {
            array_push($searchWhere, ['name', 'like', '%' . $requestParams['name'] . '%']);
        }
        return $this->cloudRepository->cloudSelect((array)$searchWhere, (int)$perSize);
    }

    public function cloudStore(array $requestParams): bool
    {
        $info = $this->dataFormatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        if ($info['code']) {
            if ($this->cloudRepository->cloudStore((array)$info)) {
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
            return $this->cloudRepository->cloudUpdate((array)$info, (array)[['id', '=', $requestParams['id']]]);
        }
        return false;
    }

    public function cloudDelete(array $requestParams): bool
    {
        $idsArray = explode(',', (string)$requestParams['ids']);
        if ($this->cloudRepository->cloudDelete((array)$idsArray)) {
            return $this->deleteToken((array)$idsArray);
        }
        return false;
    }

    /**
     * 上下架处理
     * @param array $requestParams
     * @return bool
     * @author kert
     */
    public function tokenStatus(array $requestParams): bool
    {
        $idsArray = explode(',', (string)$requestParams['ids']);
        $status   = $requestParams['status'] ?? 2;
        if ($this->cloudRepository->tokenStatus((array)$idsArray, (int)$status)) {
            if ($status == 2) {
                return $this->deleteToken((array)$idsArray);
            }
            return true;
        }
        return false;
    }

    /**
     * 根据配置删除token
     * @param array $idArray
     * @return bool
     * @author kert
     */
    private function deleteToken(array $idArray): bool
    {
        // 读取缓存配置信息
        $tokenConfig = config('app.token_delete');
        if ($tokenConfig) {
            $searchWhere = [];
            foreach ($idArray as $value) {
                array_push($searchWhere, ['id', '=', $value]);
            }
            $items = $this->cloudRepository->tokenSelectByWhere((array)$searchWhere, (array)['key']);
            if (!empty($items)) {
                $keyArray = array_column($items, 'key');
                return CacheService::deleteRedisCacheByWhere((array)$keyArray);
            }
            return true;
        }
        return true;
    }

    /**
     * 根据提交数据创建token
     * @param array $info
     * @return array
     * @author kert
     */
    private function createToken(array $info): array
    {
        $createToken         = CloudLib::createToken((int)$info['cloud_platform_id'], (array)$info);
        $info['code']        = $createToken['code'];
        $info['token']       = $createToken['token'];
        $info['expire_time'] = $createToken['expire_time'];

        return $info;
    }

    /**
     * 格式化提交表单数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    private function dataFormatter(array $requestParams): array
    {
        return [
            'cloud_platform_id' => $requestParams['cloud_platform_id'],
            'cache_time'        => trim((string)$requestParams['cache_time']),
            'key'               => $requestParams['key'] ?? (md5((string)time())),
            'app_id'            => trim($requestParams['app_id']),
            'app_secret'        => trim($requestParams['app_secret']),
            'name'              => $requestParams['name'],
            'region'            => $requestParams['region'] ?? '',
            'bucket'            => trim($requestParams['bucket']),
            'domain'            => trim($requestParams['domain']),
            'remark'            => $requestParams['remark'] ?? '',
            'token'             => '',
            'expire_time'       => date('Y-m-d H:i:s'),
            'id'                => $requestParams['id'] ?? 0,
            'status'            => $requestParams['status'] ?? 2,
        ];
    }
}