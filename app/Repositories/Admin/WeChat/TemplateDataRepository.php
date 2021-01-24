<?php
declare(strict_types=1);

namespace App\Repositories\Admin\WeChat;


use App\Model\Admin\WeChatTemplateConfigData;
use App\Repositories\RepositoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * 微信模板消息数据配置
 * Class TemplateDataRepository
 * @package App\Repositories\Admin\WeChat
 */
class TemplateDataRepository implements RepositoryInterface
{
    /**
     * @Inject()
     * @var WeChatTemplateConfigData
     */
    protected $configDataModel;

    /**
     * 数据查询
     * @param array $searchWhere 查询条件
     * @param int $perSize 分页大小
     * @return array 查询结果
     * @author ert
     */
    public function select(array $searchWhere, int $perSize): array
    {
        // TODO: Implement select() method.
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
        // TODO: Implement update() method.
    }

    /**
     * 删除数据
     * @param array $deleteWhere 删除条件
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $deleteWhere): bool
    {
        // TODO: Implement delete() method.
    }

    /**
     * 创建数据
     * @param array $createDateInfo 创建数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $createDateInfo): bool
    {
        // TODO: Implement create() method.
    }

    /**
     * 查询指定数据
     * @param array $searchWhere
     * @return array
     * @author ert
     */
    public function find(array $searchWhere): array
    {
        // TODO: Implement find() method.
    }
}