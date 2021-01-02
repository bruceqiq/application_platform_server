<?php
declare(strict_types=1);

namespace App\Controller\Common;

use App\Controller\BaseController;
use App\Services\Common\CloudPlatformService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 平台
 * Class CloudPlatformController
 * @Controller(prefix="common/cloud/platform")
 * @package App\Controller\Common
 */
class CloudPlatformController extends BaseController
{
    /**
     * @Inject()
     * @var CloudPlatformService
     */
    protected $cloudPlatformService;

    /**
     * @GetMapping(path="list")
     * @return ResponseInterface
     */
    public function index()
    {
        $items = $this->cloudPlatformService->platformSelect();

        return $this->response->success((array)$items);
    }
}