<?php
declare(strict_types=1);

namespace App\Services\Api\WeChatTemplate;


use App\Repositories\Api\WeChatTemplate\SendRepository;
use App\Services\ServiceInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * 微信模板消息
 * Class SendService
 * @package App\Services\Api\WeChatTemplate
 */
class SendService implements ServiceInterface
{
    /**
     * @Inject()
     * @var SendRepository
     */
    protected $sendRepositoy;

    /**
     * 查询数据
     * @param array $requestParams 请求参数
     * @return array 查询结果
     * @author ert
     */
    public function select(array $requestParams): array
    {
        $perSize     = $requestParams['size'] ?? 10;
        $searchWhere = [];
        if (!empty($requestParams['send_status'])) {
            array_push($searchWhere, ['send_status', '=', $requestParams['send_status']]);
        }

        return $this->sendRepositoy->select((array)$searchWhere, (int)$perSize);
    }

    /**
     * 更新数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $requestParams): bool
    {
        $updateInfo = $this->formatter((array)$requestParams);
        return $this->sendRepositoy->update((array)[['id', '=', $requestParams['id']]], (array)$updateInfo);
    }

    /**
     * 删除数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $requestParams): bool
    {
        // TODO: Implement delete() method.
    }

    /**
     * 创建数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $requestParams): bool
    {
        // TODO: Implement create() method.
    }

    /**
     * 查询单条数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    public function find(array $requestParams): array
    {
        // TODO: Implement find() method.
    }

    /**
     * 格式化数据
     * @param array $requestParams
     * @return array
     * @author kert
     */
    public function formatter(array $requestParams): array
    {
        $updateInfo = [];
        if (!empty($requestParams['msgid'])) {
            $updateInfo['msgid'] = $requestParams['msgid'];
        }
        if (!empty($requestParams['send_status'])) {
            $updateInfo['send_status'] = $requestParams['send_status'];
        }
        if (!$requestParams['send_message']) {
            $updateInfo['send_message'] = $requestParams['send_message'];
        }

        return $updateInfo;
    }

    /**
     * 批量更新数据
     * @param array $updateInfo
     */
    public function batchUpdate(array $updateInfo): void
    {
        $this->sendRepositoy->batchUpdate($updateInfo);
    }
}