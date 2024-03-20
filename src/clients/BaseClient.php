<?php

namespace Vkrsmart\Sdk\clients;

use Firebase\JWT\JWT;
use Vkrsmart\Sdk\Core\Curl;

abstract class BaseClient
{
    CONST EXP = 500;


    private string $masterKey;

    protected string $token;


    /**
     * Сделать запрос к API через интерфейс клиента
     * @param string $apiMethod
     * @param array $params
     * @param string $method
     * @return array|mixed
     */
    abstract public function makeRequest(string $apiMethod, array $params=[],string $method = "GET"): mixed;


    public function getToken(): string
    {
        return $this->token;
    }



}