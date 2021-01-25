<?php
declare(strict_types=1);

namespace App\Repositories\Admin\WeChat;


use App\Model\Admin\WeChatTemplateConfig;
use App\Repositories\RepositoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * 微信公众号模板配置
 * Class TemplateConfigRepository
 * @package App\Repositories\Admin\WeChat
 */
class TemplateConfigRepository implements RepositoryInterface
{
    /**
     * @Inject()
     * @var WeChatTemplateConfig
     */
    protected $configModel;

    /**
     * 数据查询
     * @param array $searchWhere 查询条件
     * @param int $perSize 分页大小
     * @return array 查询结果
     * @author ert
     */
    public function select(array $searchWhere, int $perSize): array
    {
        $items = $this->configModel::query()
            ->with(['token:id,key,name'])
            ->select(['id', 'token_id', 'key', 'name', 'template_id', 'url', 'appid', 'pateth', 'color',
                      'send_style', 'send_time', 'status', 'created_at'])
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
        $updateRow = $this->configModel::query()->where($updateWhere)->update($updateDataInfo);

        return $updateRow ? true : false;
    }

    /**
     * 删除数据
     * @param array $deleteWhere 删除条件
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $deleteWhere): bool
    {
        $updateRows = $this->configModel::query()->where($deleteWhere)->delete();

        return $updateRows ? true : false;
    }

    /**
     * 创建数据
     * @param array $createDataInfo 创建数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $createDataInfo): bool
    {
        $model = $this->configModel::query()->firstOrNew(['template_id' => $createDataInfo['template_id']], $createDataInfo);

        return $model->save() ? true : false;
    }

    /**
     * 查询指定数据
     * @param array $searchWhere
     * @return array
     * @author ert
     */
    public function find(array $searchWhere): array
    {
        $bean = $this->configModel::query()
            ->with(['token:id,key,name'])
            ->select(['id', 'token_id', 'key', 'name', 'template_id', 'url', 'appid', 'pateth', 'color',
                      'send_style', 'send_time', 'status', 'created_at'])
            ->where($searchWhere)
            ->get();

        return !empty($bean) ? $bean->toArray() : [];
    }
}