<?php
declare(strict_types=1);

namespace App\Repositories;

/**
 * 仓储层接口
 * Class RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * 数据查询
     * @param array $searchWhere 查询条件
     * @param int $perSize 分页大小
     * @return array 查询结果
     * @author ert
     */
    public function select(array $searchWhere, int $perSize): array;

    /**
     * 更新数据
     * @param array $updateWhere 更新条件
     * @param array $updateDataInfo 更新数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $updateWhere, array $updateDataInfo): bool;

    /**
     * 删除数据
     * @param array $deleteWhere 删除条件
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $deleteWhere): bool;

    /**
     * 创建数据
     * @param array $createDataInfo 创建数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $createDataInfo): bool;

    /**
     * 查询指定数据
     * @param array $searchWhere
     * @return array
     * @author ert
     */
    public function find(array $searchWhere): array;
}