<?php
declare(strict_types=1);

namespace App\Controller\Admin\Token;


use App\Controller\BaseController;
use App\Request\Admin\AppTokenValidate;
use App\Services\Admin\Token\TokenService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 微信
 * Class TokenController
 * @Controller(prefix="admin/app/token")
 * @package App\Controller\Admin\Token
 */
class TokenController extends BaseController
{
    /**
     * @Inject()
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @GetMapping(path="list")
     * @return ResponseInterface
     * @author kert
     */
    public function index()
    {
        $lists = $this->tokenService->tokenSelect((array)$this->request->all());

        return $this->response->success((array)$lists);
    }

    /**
     * @PostMapping(path="store")
     * @param AppTokenValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function store(AppTokenValidate $validate)
    {
        echo 1;
        $createResult = $this->tokenService->tokenCreate((array)$this->request->all());

        return $createResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @PostMapping(path="update")
     * @param AppTokenValidate $validate
     * @return ResponseInterface
     * @author kert
     */
    public function update(AppTokenValidate $validate)
    {
        $updateResult = $this->tokenService->tokenUpdate((array)$this->request->all());

        return $updateResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @PostMapping(path="del")
     * @return ResponseInterface
     * @author kert
     */
    public function delete()
    {
        $deleteResult = $this->tokenService->tokenDelete((array)$this->request->all());

        return $deleteResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @PostMapping(path="status")
     * @return ResponseInterface
     * @author kert
     */
    public function status()
    {
        $statusResult = $this->tokenService->tokenStatus($this->request->all());

        return $statusResult ? $this->response->success() : $this->response->error();
    }
}