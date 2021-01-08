<?php
declare(strict_types=1);

namespace App\Libs\Token\Handler;


use App\Libs\Guzzle\Guzzle;
use App\Libs\Token\TokenInterface;
use Hyperf\Di\Annotation\Inject;

/**
 * Token
 * Class WeChat
 * @package App\Libs\Token\Handler
 */
class TokenWeChatPublic implements TokenInterface
{
    /**
     * @Inject()
     * @var Guzzle
     */
    protected $guzzle;

    public function createToken(string $appId, string $appSecret): string
    {
        $url    = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appId}&secret={$appSecret}";
        $result = $this->guzzle->getRequest((string)$url);
        if ($result['status']) {
            return json_decode($result['data'], true)['access_token'];
        }

        return '';
    }
}