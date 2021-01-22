<?php
declare(strict_types=1);

namespace App\Controller\Admin\WeChat;

use App\Controller\BaseController;
use App\Services\Admin\WeChat\TemplateDataService;
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
        return $this->response->success();
    }

    /**
     * 创建配置
     * @PostMapping(path="store")
     * @return ResponseInterface
     * @author kert
     */
    public function store()
    {
        return $this->response->success();
    }

    /**
     * 更新配置
     * @PostMapping(path="update")
     * @return ResponseInterface
     * @author kert
     */
    public function update()
    {
        return $this->response->success();
    }

    /**
     * 删除配置
     * @PostMapping(path="del")
     * @return ResponseInterface
     * @author kert
     */
    public function delete()
    {
        return $this->response->success();
    }
}