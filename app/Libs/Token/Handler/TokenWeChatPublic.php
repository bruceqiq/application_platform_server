<?php
declare(strict_types=1);

namespace App\Libs\Token\Handler;


use App\Libs\Guzzle\Guzzle;
use App\Libs\Token\TokenInterface;
use GuzzleHttp\Exception\GuzzleException;
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

    /**
     * 生成微信公众号access_token
     * @param string $appId
     * @param string $appSecret
     * @return string
     * @throws GuzzleException
     * @author ert
     */
    public function createToken(string $appId, string $appSecret): string
    {
        $url    = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appId}&secret={$appSecret}";
        $result = $this->guzzle->getRequest((string)$url);

        var_dump('result', $result);
        if ($result['status']) {
            $accessTokenArray = json_decode($result['data'], true);
            var_dump('解析数据', $result);
            return !isset($accessTokenArray['errcode']) ? $accessTokenArray['access_token'] : '';
        }

        return '';
    }
}