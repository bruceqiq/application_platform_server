<?php
declare(strict_types=1);

namespace App\Controller\Admin\WeChat;


use App\Controller\BaseController;
use App\Request\Admin\WeChatTemplateConfigValidate;
use App\Services\Admin\WeChat\TemplateConfigService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 微信公众号模板消息配置
 * Class TemplateConfigController
 * @Controller(prefix="wechat_public_template")
 * @package App\Controller\Admin\WeChat
 */
class TemplateConfigController extends BaseController
{
    /**
     * @Inject()
     * @var TemplateConfigService
     */
    protected $templateConfigService;

    /**
     * 查询配置
     * @GetMapping(path="list")
     * @return ResponseInterface
     * @author kert
     */
    public function index()
    {
        $items = $this->templateConfigService->select((array)$this->request->all());

        return $this->response->success((array)$items);
    }

    /**
     * 创建配置
     * @PostMapping(path="store")
     * @param WeChatTemplateConfigValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function store(WeChatTemplateConfigValidate $validate)
    {
        $createResult = $this->templateConfigService->create((array)$this->request->all());

        return $createResult ? $this->response->success() : $this->response->error();
    }

    /**
     * 更新配置
     * @PostMapping(path="update")
     * @param WeChatTemplateConfigValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function update(WeChatTemplateConfigValidate $validate)
    {
        $updateResult = $this->templateConfigService->update((array)$this->request->all());

        return $updateResult ? $this->response->success() : $this->response->error();
    }

    /**
     * 删除配置
     * @PostMapping(path="del")
     * @return ResponseInterface
     * @author kert
     */
    public function delete()
    {
        $deleteResult = $this->templateConfigService->delete((array)$this->request->all());

        return $deleteResult ? $this->response->success() : $this->response->error();
    }
}