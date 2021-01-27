<?php
declare(strict_types=1);

namespace App\Controller\Admin\WeChat;

use App\Controller\BaseController;
use App\Request\Admin\WeChatTemplateConfigDataValidate;
use App\Services\Admin\WeChat\TemplateDataService;
use App\Services\ServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 微信模板数据配置
 * Class TemplateDataController
 * @Controller(prefix="wechat_public_template_data")
 * @package App\Controller\Admin\WeChat
 */
class TemplateDataController extends BaseController
{
    /**
     * @Inject()
     * @var TemplateDataService
     */
    protected $templateDataService;

    /**
     * 查询配置
     * @GetMapping(path="list")
     * @return ResponseInterface
     * @author kert
     */
    public function index()
    {
        $items = $this->templateDataService->select((array)$this->request->all());

        return $this->response->success((array)$items);
    }

    /**
     * 创建配置
     * @PostMapping(path="store")
     * @param WeChatTemplateConfigDataValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function store(WeChatTemplateConfigDataValidate $validate)
    {
        $createResult = $this->templateDataService->create((array)$this->request->all());

        return $createResult ? $this->response->success() : $this->response->error();
    }

    /**
     * 更新配置
     * @PostMapping(path="update")
     * @param WeChatTemplateConfigDataValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function update(WeChatTemplateConfigDataValidate $validate)
    {
        $updateResult = $this->templateDataService->update((array)$this->request->all());

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
        $deleteResult = $this->templateDataService->delete((array)$this->request->all());

        return $deleteResult ? $this->response->success() : $this->response->error();
    }
}