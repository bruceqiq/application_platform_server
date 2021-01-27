<?php
declare(strict_types=1);

namespace App\Repositories\Admin\Token;

use App\Model\Admin\TokenStorage;
use App\Model\Db\CommonDb;
use App\Repositories\RepositoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * Class TokenRepositories
 * @package App\Repositories\Admin\WeChat
 */
class TokenRepository implements RepositoryInterface
{
    /**
     * @Inject()
     * @var TokenStorage
     */
    private $tokenModel;

    /**
     * 数据查询
     * @param array $searchWhere 查询条件
     * @param int $perSize 分页大小
     * @return array 查询结果
     * @author ert
     */
    public function select(array $searchWhere, int $perSize): array
    {
        $items = $this->tokenModel::query()
            ->with(['platform:id,name'])
            ->select($this->tokenModel->searchFields)
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
     * 更新数据
     * @param array $updateWhere 更新条件
     * @param array $updateDataInfo 更新数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $updateWhere, array $updateDataInfo): bool
    {
        try {
            $result = $this->tokenModel::query()->where($updateWhere)->update($updateDataInfo);
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
        $result = $this->tokenModel::query()->where($deleteWhere)->delete();

        return $result ? true : false;
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
            $result = $this->tokenModel::query()->create($createDateInfo);
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
        $bean = $this->tokenModel::query()->with(['platform:id,name'])->where($searchWhere)->first($this->tokenModel->searchFields);

        if (!empty($bean)) {
            return $bean->toArray();
        }

        return [];
    }

    public function tokenSelectByWhere(array $searchWhere, array $searchFields = ['*']): array
    {
        return CommonDb::selectByWhere((string)$this->tokenModel->getTable(), (array)$searchWhere, (array)$searchFields);
    }
}