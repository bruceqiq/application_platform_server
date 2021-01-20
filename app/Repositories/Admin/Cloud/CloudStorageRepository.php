<?php
declare(strict_types=1);

namespace App\Repositories\Admin\Cloud;

use App\Model\Admin\CloudStorage;
use App\Model\Db\CommonDb;
use Hyperf\Di\Annotation\Inject;

/**
 * 云服务存储
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

    public function cloudSelect(array $searchWhere, int $perSize): array
    {
        $items = $this->cloudModel::query()
            ->with(['platform:id,name'])
            ->select($this->cloudModel->searchFields)
            ->where($searchWhere)
            ->paginate($perSize);

        return [
            'items' => $items->items(),
            'page'  => $items->currentPage(),
            'size'  => $perSize,
            'total' => $items->total(),
        ];
    }

    public function tokenSelectByWhere(array $searchWhere, array $searchFields = ['*']): array
    {
        return CommonDb::selectByWhere((string)$this->cloudModel->getTable(), (array)$searchWhere, (array)$searchFields);
    }

    public function cloudStore(array $requestParams): bool
    {
        try {
            $result = $this->cloudModel::query()->create($requestParams);
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result ? true : false;
    }

    public function cloudUpdate(array $requestParams, array $updateWhere): bool
    {
        try {
            $result = $this->cloudModel::query()->where($updateWhere)->update($requestParams);
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result ? true : false;
    }

    public function cloudDelete(array $deleteIdArray): bool
    {
        $result = $this->cloudModel::query()->whereIn('id', $deleteIdArray)->delete();

        return $result ? true : false;
    }

    public function tokenStatus(array $updateWhere, int $status): bool
    {
        $result = $this->cloudModel::query()->whereIn('id', $updateWhere)->update([
            'status' => $status,
        ]);

        return $result ? true : false;
    }
}