<?php
declare(strict_types=1);

namespace App\Libs\Guzzle;


use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Guzzle\ClientFactory;

/**
 * Class Guzzle
 * @package App\Libs\Guzzle
 */
class Guzzle
{
    protected $guzzleClient;

    public function __construct(ClientFactory $clientFactory)
    {
        $this->guzzleClient = $clientFactory;
    }

    /**
     * Get请求
     * @param string $uri 请求地址
     * @param array $options 请求选项
     * @return array 返回参数
     * @throws GuzzleException
     * @author kert
     */
    public function getRequest(string $uri, array $options = [])
    {
        $client   = $this->guzzleClient->create((array)['base_uri' => $uri]);
        $response = $client->get($uri, $options);
        if ($response->getStatusCode() == 200) {
            return [
                'status' => 1,
                'data'   => $response->getBody()->getContents()
            ];
        }
        return [
            'status' => 0,
            'data'   => '',
        ];
    }

    public function postRequest(string $uri, array $options = [])
    {
        $client   = $this->guzzleClient->create((array)['base_uri' => $uri]);
        $response = $client->request('post', $uri, $options);
        if ($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        }
        return null;
    }
}