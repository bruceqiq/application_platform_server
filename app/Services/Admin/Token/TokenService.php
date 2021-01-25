<?php
declare(strict_types=1);

namespace App\Services\Admin\Token;

use App\Libs\Cache\Redis;
use App\Libs\Token\TokenLib;
use App\Repositories\Admin\Token\TokenRepository;
use App\Services\App\CacheService;
use App\Services\ServiceInterface;
use Hyperf\Di\Annotation\Inject;


/**
 * Class TokenService
 * @package App\Services\Admin\Token
 */
class TokenService implements ServiceInterface
{
    /**
     * @Inject()
     * @var TokenRepository
     */
    private $tokenRepository;

    /**
     * 查询数据
     * @param array $requestParams 请求参数
     * @return array
     * @author ert
     */
    public function select(array $requestParams): array
    {
        $perSize     = $requestParams['size'] ?? 20;
        $searchWhere = [];
        if (!empty($requestParams['id'])) {
            array_push($searchWhere, ['id', '=', $requestParams['id']]);
        }
        if (!empty($requestParams['name'])) {
            array_push($searchWhere, ['name', 'like', '%' . $requestParams['name'] . '%']);
        }
        return $this->tokenRepository->select((array)$searchWhere, (int)$perSize);
    }

    /**
     * 创建数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $requestParams): bool
    {
        $info = $this->formatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        if ($info['code']) {
            if ($this->tokenRepository->create((array)$info)) {
                return true;
            }
            (Redis::getRedisInstance())->redis->del($info['key']);
            return false;
        }
        return false;
    }

    /**
     * 更新数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $requestParams): bool
    {
        $info = $this->formatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        var_dump('info', $info);

        if ($info['code']) {
            unset($info['key']);
            unset($info['code']);
            return $this->tokenRepository->update((array)[['id', '=', $requestParams['id']]], (array)$info);
        }
        return false;
    }

    /**
     * 删除数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $requestParams): bool
    {
        $idsArray = explode(',', (string)$requestParams['ids']);

        $deleteWhere = [];
        foreach ($idsArray as $value) {
            array_push($deleteWhere, ['id', '=', $value]);
        }
        if ($this->tokenRepository->delete((array)$deleteWhere)) {
            return $this->deleteToken((array)$idsArray);
        }
        return false;
    }

    /**
     * 设置上下架状态
     * @param array $requestParams
     * @return bool
     * @author kert
     */
    public function tokenStatus(array $requestParams): bool
    {
        $idsArray    = explode(',', (string)$requestParams['ids']);
        $status      = $requestParams['status'] ?? 2;
        $updateWhere = [];
        foreach ($idsArray as $value) {
            array_push($updateWhere, ['id', '=', $value]);
        }
        if ($this->tokenRepository->update((array)$updateWhere, (array)['status' => $status])) {
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
            $items = $this->tokenRepository->tokenSelectByWhere((array)$searchWhere, (array)['key']);
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
        $createToken         = TokenLib::createToken((int)$info['cloud_platform_id'], (array)$info);
        $info['code']        = $createToken['code'];
        $info['token']       = $createToken['token'];
        $info['expire_time'] = $createToken['expire_time'];

        return $info;
    }

    /**
     * 查询单条数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    public function find(array $requestParams): array
    {
        // TODO: Implement find() method.
    }

    /**
     * 格式化数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    public function formatter(array $requestParams): array
    {
        return [
            'cloud_platform_id' => $requestParams['cloud_platform_id'],
            'key'               => $requestParams['key'] ?? (md5((string)time())),
            'app_id'            => trim($requestParams['app_id']),
            'app_secret'        => trim($requestParams['app_secret']),
            'name'              => $requestParams['name'],
            'domain'            => trim($requestParams['domain']),
            'remark'            => $requestParams['remark'] ?? '',
            'token'             => '',
            'cache_time'        => $requestParams['cache_time'] ?? 7200,
            'expire_time'       => date('Y-m-d H:i:s'),
            'id'                => $requestParams['id'] ?? 0,
            'status'            => $requestParams['status'] ?? 2,
        ];
    }
}