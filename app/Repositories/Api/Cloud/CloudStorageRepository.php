<?php
declare(strict_types=1);

namespace App\Repositories\Api\Cloud;

use App\Model\Api\CloudStorage;
use Hyperf\Di\Annotation\Inject;

/**
 * Class CloudService
 * @package App\Repositories\Admin\Cloud
 */
class CloudStorageRepository
{
    /**
     * @Inject()
     * @var CloudStorage
     */
    private $cloudModel;

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