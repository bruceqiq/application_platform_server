<?php
declare(strict_types=1);

namespace App\Services\Admin\WeChat;

use App\Repositories\Admin\WeChat\TemplateDataRepository;
use App\Services\ServiceInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * 微信公众号模板消息数据
 * Class TemplateDataService
 * @package App\Services\Admin\WeChat
 */
class TemplateDataService implements ServiceInterface
{
    /**
     * @Inject()
     * @var TemplateDataRepository
     */
    protected $templateDataRepository;

    /**
     * 查询数据
     * @param array $requestParams 请求参数
     * @return array 查询结果
     * @author ert
     */
    public function select(array $requestParams): array
    {
        $searchWhere = [['wechat_template_config_id', '=', $requestParams['config_id'] ?? 0]];

        return $this->templateDataRepository->select((array)$searchWhere, (int)$requestParams['size'] ?? 20);
    }

    /**
     * 更新数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $requestParams): bool
    {
        return $this->templateDataRepository->update(
            (array)['id' => $requestParams['id']],
            (array)$this->formatter((array)$requestParams)
        );
    }

    /**
     * 删除数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function delete(array $requestParams): bool
    {
        $idStr   = explode(',', $requestParams['ids']);
        $idArray = [];
        foreach ($idStr as $value) {
            array_push($idArray, ['id', '=', $value]);
        }

        return $this->templateDataRepository->delete((array)$idArray);
    }

    /**
     * 创建数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $requestParams): bool
    {
        return $this->templateDataRepository->create((array)$this->formatter((array)$requestParams));
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
        return [
            'wechat_template_config_id' => $requestParams['config_id'],
            'key_name'                  => trim($requestParams['key_name']),
            'key_value'                 => $requestParams['key_value'] ?? '无',
            'key_color'                 => $requestParams['key_color'] ?? '#fff',
            'status'                    => $requestParams['status'] ?? 1,
        ];
    }
}