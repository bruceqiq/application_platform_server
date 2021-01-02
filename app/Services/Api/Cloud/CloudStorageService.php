<?php
declare(strict_types=1);

namespace App\Services\Api\Cloud;

use App\Libs\Cloud\CloudLib;
use App\Repositories\Api\Cloud\CloudStorageRepositories;

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
        $this->cloudRepositories = new CloudStorageRepositories();
    }

    public function findCloud(array $requestParams): array
    {
        $searchWhere = [['key', '=', $requestParams['key']]];
        $bean        = $this->cloudRepositories->cloudFind((array)$searchWhere);
        if (!empty($bean)) {
            $createToken         = CloudLib::createToken((int)$bean['cloud_platform_id'], (array)$bean);
            $bean['token']       = $createToken['token'];
            $bean['expire_time'] = $createToken['expire_time'];
            if ($createToken['code']) {
                // 更新数据库 token
                $this->cloudRepositories->cloudUpdate(
                    (array)['token' => $createToken['token']],
                    (array)[['key', '=', $requestParams['key']]]);
            }
            return $bean;
        }

        return $bean;
    }

}