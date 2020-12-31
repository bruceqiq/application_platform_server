<?php
declare(strict_types=1);

namespace App\Controller;

use App\Functions\HttpDataResponse;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController
{
    protected $response = null;

    protected $request = null;

    public function __construct(RequestInterface $request, HttpDataResponse $response)
    {
        $this->response = $response;
        $this->request  = $request;
    }
}