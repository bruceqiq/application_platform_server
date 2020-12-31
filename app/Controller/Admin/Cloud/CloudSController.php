<?php
declare(strict_types=1);

namespace App\Controller\Admin\Cloud;

use App\Controller\BaseController;
use App\Services\Admin\Cloud\CloudService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 云服务
 * Class CloudSController
 * @Controller(prefix="admin/cloud")
 * @package App\Controller\Admin\Cloud
 */
class CloudSController extends BaseController
{
    /**
     * @Inject()
     * @var CloudService
     */
    protected $cloudStoreService;

    /**
     * @GetMapping(path="list")
     * @return ResponseInterface
     * @author kert
     */
    public function index()
    {
        $lists = $this->cloudStoreService->cloudSelect((array)$this->request->all());

        return $this->response->success((array)$lists);
    }

    /**
     * @PostMapping(path="store")
     * @return ResponseInterface
     * @author kert
     */
    public function store()
    {
        $createResult = $this->cloudStoreService->cloudStore((array)$this->request->all());

        return $createResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @PutMapping(path="update")
     * @return ResponseInterface
     * @author kert
     */
    public function update()
    {
        return $this->response->success();
    }

    /**
     * @DeleteMapping(path="del")
     * @return ResponseInterface
     * @author kert
     */
    public function delete()
    {
        return $this->response->success();
    }
}