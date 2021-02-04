<?php
declare(strict_types=1);

namespace App\Repositories\Api\WeChatTemplate;


use App\Model\Api\WeChatTemplateSend;
use App\Repositories\RepositoryInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * 微信模板消息
 * Class SendRepository
 * @package App\Repositories\Api\WeChatTemplate
 */
class SendRepository implements RepositoryInterface
{
    /**
     * @Inject()
     * @var WeChatTemplateSend
     */
    protected $sendModel;

    /**
     * 数据查询
     * @param array $searchWhere 查询条件
     * @param int $perSize 分页大小
     * @return array 查询结果
     * @author ert
     */
    public function select(array $searchWhere, int $perSize): array
    {
        $items = $this->sendModel::query()->with([
            'token:id,name,token',
            'template:id,name,template_id',
        ])->where($searchWhere)
            ->select($this->sendModel->listSearchFields)
            ->paginate($perSize);

        return [
            'items' => $items->items(),
            'total' => $items->total(),
            'page'  => $items->currentPage(),
            'size'  => $items->perPage(),
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
        $updateRows = $this->sendModel::query()->where($updateWhere)->update($updateDataInfo);

        return $updateRows ? true : false;
    }

    /**
     * 删除数据
     * @param array $deleteWhere 删除条件
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $deleteWhere): bool
    {
        $deleteRows = $this->sendModel::query()->where($deleteWhere)->delete();

        return $deleteRows ? true : false;
    }

    /**
     * 创建数据
     * @param array $createDataInfo 创建数据
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $createDataInfo): bool
    {
        $createModel = $this->sendModel::query()->create($createDataInfo);

        return !empty($createModel) ? true : false;
    }

    /**
     * 查询指定数据
     * @param array $searchWhere
     * @return array
     * @author ert
     */
    public function find(array $searchWhere): array
    {
        $bean = $this->sendModel::query()->with([
            'token:id,name,token',
            'template:id,name,template_id',
        ])->where($searchWhere)
            ->first($this->sendModel->listSearchFields);

        return !empty($bean) ? $bean->toArray() : [];
    }
}