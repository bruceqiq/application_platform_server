<?php
declare(strict_types=1);

namespace App\Repositories\Api\Cloud;

use App\Model\Api\CloudStorage;

/**
 * 云服务存储
 * Class CloudService
 * @package App\Repositories\Admin\Cloud
 */
class CloudStorageRepositories
{
    private $cloudModel = null;

    public function __construct()
    {
        $this->cloudModel = new CloudStorage;
    }

    public function cloudFind(array $searchWhere): array
    {
        $bean = $this->cloudModel::query()->where($searchWhere)->first($this->cloudModel->searchFields);

        return !empty($bean) ? $bean->toArray() : [];
    }

    public function cloudUpdate(array $info, array $updateWhere): bool
    {
        $result = $this->cloudModel::query()->where($updateWhere)->update($info);

        return $result ? true : false;
    }
}