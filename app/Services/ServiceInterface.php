<?php
declare(strict_types=1);

namespace App\Services;

/**
 * 服务层接口
 * Interface ServiceInterface
 * @package App\Services
 */
interface ServiceInterface
{
    /**
     * 查询数据
     * @param array $requestParams 请求参数
     * @return array 查询结果
     * @author ert
     */
    public function select(array $requestParams): array;

    /**
     * 更新数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $requestParams): bool;

    /**
     * 删除数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $requestParams): bool;

    /**
     * 创建数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $requestParams): bool;

    /**
     * 查询单条数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    public function find(array $requestParams): array;

    /**
     * 格式化数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    public function formatter(array $requestParams): array;
}