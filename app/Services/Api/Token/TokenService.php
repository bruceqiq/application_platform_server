<?php
declare(strict_types=1);

namespace App\Services\Api\Token;

use App\Libs\Token\TokenLib;
use App\Repositories\Api\Token\TokenRepository;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Di\Annotation\Inject;

/**
 * Class TokenService
 * @package App\Services\Api\Token
 */
class TokenService
{
    /**
     * @Inject()
     * @var TokenRepository
     */
    private $tokenRepository;

    /**
     * 查询token自动生成缓存
     * @param array $requestParams
     * @return array
     * @throws GuzzleException
     * @author ert
     */
    public function findCloud(array $requestParams): array
    {
        $searchWhere = [['key', '=', $requestParams['key'] ?? 0], ['status', '=', 1]];
        $bean        = $this->tokenRepository->cloudFind((array)$searchWhere);
        if (!empty($bean)) {
            $createToken         = TokenLib::createToken((int)$bean['cloud_platform_id'], (array)$bean);
            $bean['token']       = $createToken['token'];
            $bean['expire_time'] = $createToken['expire_time'];
            if ($createToken['code']) {
                // 更新数据库 token
                $this->tokenRepository->cloudUpdate(
                    (array)['token' => $createToken['token'], 'expire_time' => $createToken['expire_time']],
                    (array)[['key', '=', $requestParams['key']]]);
            }
            return $bean;
        }

        return $bean;
    }

    /**
     * 查询所有Token数据
     * @return array
     */
    public function select(array $requestParams): array
    {
        $searchWhere = [];
        if (!empty($requestParams['expire_time'])) {
            array_push($searchWhere, ['expire_time', '<', $requestParams['expire_time']]);
        }

        return $this->tokenRepository->cloudSelect((array)$searchWhere, (array)['key']);
    }
}