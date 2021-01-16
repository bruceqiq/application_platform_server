<?php
declare(strict_types=1);

namespace App\Services\Admin\Token;

use App\Libs\Cache\Redis;
use App\Libs\Token\TokenLib;
use App\Repositories\Admin\Token\TokenRepository;

/**
 * 微信
 * Class TokenService
 * @package App\Services\Admin\Token
 */
class TokenService
{
    private $tokenRepository;

    public function __construct()
    {
        $this->tokenRepository = new TokenRepository();
    }

    public function tokenSelect(array $requestParams): array
    {
        $perSize     = $requestParams['size'] ?? 20;
        $searchWhere = [];
        if (!empty($requestParams['id'])) {
            array_push($searchWhere, ['id', '=', $requestParams['id']]);
        }
        if (!empty($requestParams['name'])) {
            array_push($searchWhere, ['name', 'like', '%' . $requestParams['name'] . '%']);
        }

        return $this->tokenRepository->tokenSelect((array)$searchWhere, (int)$perSize);
    }

    public function tokenCreate(array $requestParams): bool
    {
        $info = $this->dataFormatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        if ($info['code']) {
            if ($this->tokenRepository->tokenCreate((array)$info)) {
                return true;
            }
            echo __CLASS__ . "||" . __METHOD__;
            (Redis::getRedisInstance())->redis->del($info['key']);
            return false;
        }
        return false;
    }

    public function tokenUpdate(array $requestParams): bool
    {
        $info = $this->dataFormatter((array)$requestParams);
        $info = $this->createToken((array)$info);
        var_dump('info', $info);
        if ($info['code']) {
            unset($info['key']);
            unset($info['code']);
            return $this->tokenRepository->tokenUpdate((array)$info, (array)[['id', '=', $requestParams['id']]]);
        }
        return false;
    }

    public function tokenDelete(array $requestParams): bool
    {
        // 是否在删除数据之后，立即删除 token
        //$key = $this->tokenSelect((array)['id' => $requestParams['id']])['items'][0]['key'];
        $idsArray = explode(',', (string)$requestParams['ids']);
        if ($this->tokenRepository->tokenDelete((array)$idsArray)) {
            return true;
        }
        return false;
    }

    public function tokenStatus(array $requestParams): bool
    {
        $idsArray = explode(',', (string)$requestParams['ids']);
        if ($this->tokenRepository->tokenStatus((array)$idsArray, (int)$requestParams['status'] ?? 2)) {
            return true;
        }
        return false;
    }

    private function createToken(array $info): array
    {
        $createToken         = TokenLib::createToken((int)$info['cloud_platform_id'], (array)$info);
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