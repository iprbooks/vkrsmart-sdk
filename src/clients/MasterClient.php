<?php

namespace Vkrsmart\Sdk\clients;

use Firebase\JWT\JWT;
use Vkrsmart\Sdk\Core\Curl;

class MasterClient extends BaseClient
{
    CONST EXP = 500;


    private string $masterKey;


    /**
     * Конструктор Master Client
     * @param string $masterKey
     */
    public function __construct(string $masterKey)
    {
        $this->masterKey = $masterKey;
    }

    /**
     * Сделать запрос к API через интерфейс клиента
     * @param string $apiMethod
     * @param array $params
     * @param string $method
     * @return string|array
     * @throws \Exception
     */
    public function makeRequest(string $apiMethod, array $params=[],string $method = "GET"): string|array
    {
        $payload = [
            'exp' => time() + self::EXP,
        ];
        $token = JWT::encode($payload, $this->masterKey, 'HS256');
        $params = array_merge($params);
        $result = Curl::exec($apiMethod, $token, $params,$method);
        return $result;
    }
}