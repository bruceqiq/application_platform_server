<?php
declare(strict_types=1);

namespace App\Repositories\Admin\Cloud;

use App\Model\Api\Cloud;

/**
 * 云服务
 * Class CloudService
 * @package App\Repositories\Admin\Cloud
 */
class CloudRepositories
{
    private $cloudModel = null;

    public function __construct()
    {
        $this->cloudModel = new Cloud();
    }

    public function cloudSelect(array $requestParams): array
    {
        return [
            time(),
            $requestParams
        ];
    }

    public function cloudStore(array $requestParams): bool
    {
        $result = $this->cloudModel::query()->firstOrCreate([
            'name'   => $requestParams['name'],
            'app_id' => $requestParams['app_id']],
            $requestParams);

        return $result ? true : false;
    }

    public function cloudUpdate(array $requestParams): bool
    {
        return false;
    }

    public function cloudDelete(array $requestParams): bool
    {
        return false;
    }
}