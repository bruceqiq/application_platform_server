<?php
declare(strict_types=1);

namespace App\Controller\Admin\Cloud;

use App\Controller\BaseController;
use App\Request\Admin\CloudStorageValidate;
use App\Services\Admin\Cloud\CloudStorageService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 云服务存储
 * Class CloudSController
 * @Controller(prefix="admin/cloud/storage")
 * @package App\Controller\Admin\Cloud
 */
class CloudStorageController extends BaseController
{
    /**
     * @Inject()
     * @var CloudStorageService
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
     * @param CloudStorageValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function store(CloudStorageValidate $validate)
    {
        $createResult = $this->cloudStoreService->cloudStore((array)$this->request->all());

        return $createResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @PutMapping(path="update")
     * @param CloudStorageValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function update(CloudStorageValidate $validate)
    {
        $updateResult = $this->cloudStoreService->cloudUpdate((array)$this->request->all());

        return $updateResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @DeleteMapping(path="del")
     * @return ResponseInterface
     * @author kert
     */
    public function delete()
    {
        $deleteResult = $this->cloudStoreService->cloudDelete((array)$this->request->all());

        return $deleteResult ? $this->response->success() : $this->response->error();
    }
}