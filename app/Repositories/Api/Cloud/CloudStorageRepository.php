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

    /**
     * 查询所有token信息
     * @param array $searchWhere 查询条件
     * @param array $searchFields 查询字段
     * @param int $perSize 分页大小
     * @return array
     */
    public function cloudSelect(array $searchWhere, array $searchFields = ['*'], int $perSize = 10): array
    {
        $items = $this->cloudModel::query()
            ->where($searchWhere)
            ->select($searchFields)
            ->paginate($perSize);

        return [
            'items' => $items->items(),
            'total' => $items->total(),
            'page'  => $items->currentPage(),
            'size'  => $perSize,
        ];
    }
}