<?php
declare(strict_types=1);

namespace App\Repositories\Admin\Cloud;

use App\Model\Admin\CloudStorage;
use App\Model\Db\CommonDb;
use App\Repositories\RepositoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * Class CloudService
 * @package App\Repositories\Admin\Cloud
 */
class CloudStorageRepository implements RepositoryInterface
{
    /**
     * @Inject()
     * @var CloudStorage
     */
    private $cloudModel;

    /**
     * 数据查询
     * @param array $searchWhere 查询条件
     * @param int $perSize 分页大小
     * @return array 查询结果
     * @author ert
     */
    public function select(array $searchWhere, int $perSize): array
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

    /**
     * 创建数据
     * @param array $createDateInfo 创建数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $createDateInfo): bool
    {
        try {
            $result = $this->cloudModel::query()->create($createDateInfo);
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result ? true : false;
    }

    /**
     * 查询指定数据
     * @param array $searchWhere
     * @return array
     * @author ert
     */
    public function find(array $searchWhere): array
    {
        $items = $this->cloudModel::query()->where($searchWhere)->get(['*']);
        if (!empty($items)) {
            return $items->toArray();
        }
        return [];
    }

    /**
     * 更新数据
     * @param array $updateWhere 更新条件
     * @param array $updateDataInfo 更新数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $updateWhere, array $updateDataInfo): bool
    {
        try {
            $result = $this->cloudModel::query()->where($updateWhere)->update($updateDataInfo);
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result ? true : false;
    }

    /**
     * 删除数据
     * @param array $deleteWhere 删除条件
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $deleteWhere): bool
    {
        $result = $this->cloudModel::query()->where($deleteWhere)->delete();

        return $result ? true : false;
    }

    public function tokenSelectByWhere(array $searchWhere, array $searchFields = ['*']): array
    {
        return CommonDb::selectByWhere((string)$this->cloudModel->getTable(), (array)$searchWhere, (array)$searchFields);
    }
}