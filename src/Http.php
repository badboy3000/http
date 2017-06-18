<?php

namespace Vbot\Http;

use GuzzleHttp\Client;
use Hanson\Vbot\Extension\AbstractMessageHandler;
use Illuminate\Support\Collection;

class Http extends AbstractMessageHandler
{
    public $author = 'JaQuan';

    public $version = '1.0';

    public $name = 'http';

    public $zhName = 'cURL 单例请求器';

    public static $client = null;

    public function handler(Collection $message)
    {
    }

    /**
     * 注册拓展时的操作.
     */
    public function register()
    {
        static::$client = new Client();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return  string
     */
    public static function request($method, $uri = '', array $options = [])
    {
        $options = array_merge(['timeout' => 10, 'verify' => false], $options);

        $response = static::$client->request($method, $uri, $options);

        return $response->getBody()->getContents();
    }
}