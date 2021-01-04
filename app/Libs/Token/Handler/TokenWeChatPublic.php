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
        $url    = 'https://api.weixin.qq.com/cgi-bin/token';
        $result = $this->guzzle->getRequest((string)$url, (array)[
            'grant_type' => 'client_credential',
            'appid'      => $appId,
            'secret'     => $appSecret,
        ]);
        var_dump(json_decode($result, true));
    }
}