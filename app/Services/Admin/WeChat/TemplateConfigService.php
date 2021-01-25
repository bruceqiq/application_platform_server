<?php
declare(strict_types=1);

namespace App\Services\Admin\WeChat;

use App\Repositories\Admin\WeChat\TemplateConfigRepository;
use App\Services\ServiceInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * 微信公众号模板消息配置
 * Class TemplateConfigService
 * @package App\Services\Admin\WeChat
 */
class TemplateConfigService implements ServiceInterface
{

    /**
     * @Inject()
     * @var TemplateConfigRepository
     */
    protected $templateRepository;

    /**
     * 查询数据
     * @param array $requestParams 请求参数
     * @return array 查询结果
     * @author ert
     */
    public function select(array $requestParams): array
    {
        return $this->templateRepository->select((array)[], (int)$requestParams['size'] ?? 20);
    }

    /**
     * 更新数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $requestParams): bool
    {
        return $this->templateRepository->update(
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

        return $this->templateRepository->delete((array)$idArray);
    }

    /**
     * 创建数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function create(array $requestParams): bool
    {
        return $this->templateRepository->create((array)$this->formatter((array)$requestParams));
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
     * 格式化表单参数
     * @param array $requestParams 请求参数
     * @return array 格式化后的数据
     * @author kert
     */
    public function formatter(array $requestParams): array
    {
        return [
            'token_id'    => $requestParams['token_id'],
            'key'         => md5((string)time()),
            'name'        => trim($requestParams['name']),
            'template_id' => trim($requestParams['template_id']),
            'url'         => $requestParams['url'] ?? '',
            'appid'       => $requestParams['appid'] ?? '',
            'pateth'      => $requestParams['pateth'] ?? '',
            'color'       => $requestParams['color'] ?? '',
            'send_style'  => $requestParams['send_style'],
            'send_time'   => $requestParams['send_time'],
            'status'      => $requestParams['status'],
        ];
    }
}