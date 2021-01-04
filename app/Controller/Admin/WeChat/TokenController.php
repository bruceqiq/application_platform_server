<?php
declare(strict_types=1);

namespace App\Controller\Admin\WeChat;


use App\Controller\BaseController;
use App\Services\Admin\WeChat\TokenService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Psr\Http\Message\ResponseInterface;

/**
 * 微信
 * Class TokenController
 * @package App\Controller\Admin\WeChat
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
     * @return ResponseInterface
     * @author kert
     */
    public function store()
    {
        $createResult = $this->tokenService->tokenCreate((array)$this->request->all());

        return $createResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @PutMapping(path="update")
     * @return ResponseInterface
     * @author kert
     */
    public function update()
    {
        $updateResult = $this->tokenService->tokenUpdate((array)$this->request->all());

        return $updateResult ? $this->response->success() : $this->response->error();
    }

    /**
     * @DeleteMapping(path="del")
     * @return ResponseInterface
     * @author kert
     */
    public function delete()
    {
        $deleteResult = $this->tokenService->tokenDelete((array)$this->request->all());

        return $deleteResult ? $this->response->success() : $this->response->error();
    }
}