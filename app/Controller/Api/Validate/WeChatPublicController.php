<?php
declare(strict_types=1);

namespace App\Controller\Api\Validate;

use App\Controller\BaseController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * 第三方平台服务器验证
 * Class WeChatPublicController
 * @Controller(prefix="validate/wechat/public")
 * @package App\Controller\Api\Validate
 */
class WeChatPublicController extends BaseController
{
    /**
     * 微信公众号服务器验证
     * @GetMapping(path="token")
     * @return bool
     * @author kert
     */
    public function token()
    {
        $signature = $this->request->input('signature', '');
        $timestamp = $this->request->input('timestamp', '');
        $nonce     = $this->request->input('nonce', '');

        $token  = 'weixin';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode(',', $tmpArr);
        $tmpStr = sha1($tmpStr);

        return $tmpStr == $signature ? true : false;
    }
}