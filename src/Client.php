<?php

namespace Vkrsmart\Sdk;


use Exception;
use Firebase\JWT\JWT;
use Vkrsmart\Sdk\Core\Curl;

class Client
{
    CONST EXP = 5000;
    /*
     * id организации
     */
    private $organisationId;

    /*
     * Секретный ключ
     */
    private string $secretKey;


    /**
     * Конструктор Client
     * @param $organisationId
     * @param $secretKey
     * @throws Exception
     */
    public function __construct($organisationId, $secretKey)
    {
        if (!is_numeric($organisationId)) {
            throw new Exception('id must be numeric');
        }
        $this->organisationId = $organisationId;
        $this->secretKey = $secretKey;
    }

    /**
     * @param $apiMethod
     * @param array $params
     * @param string $method
     * @return array
     * @throws Exception
     */
    public function makeRequest($apiMethod, array $params=[], string $method="GET"):array
    {
        $payload = [
            "organization_id" => $this->organisationId,
            'iat' => time(),
            'exp' => time() + self::EXP,
        ];
        $token = JWT::encode($payload, $this->secretKey, 'HS256');
        return Curl::exec($apiMethod, $token, $params,$method);
    }

}
