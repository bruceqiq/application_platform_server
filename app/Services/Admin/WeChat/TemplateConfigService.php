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
        // TODO: Implement select() method.
    }

    /**
     * 更新数据
     * @param array $requestParams 请求参数
     * @return bool true:成功|false:失败
     * @author ert
     */
    public function update(array $requestParams): bool
    {
        // TODO: Implement update() method.
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
}