<?php

namespace Vkrsmart\Sdk\clients;


use Exception;
use Firebase\JWT\JWT;
use Vkrsmart\Sdk\Core\Curl;

class Client extends BaseClient
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
     * @param string $apiMethod
     * @param array $params
     * @param string $method
     * @return array
     * @throws Exception
     */
    public function makeRequest(string $apiMethod, array $params=[], string $method="GET"):array
    {
        $payload = [
            "organization_id" => $this->organisationId,
            'iat' => time(),
            'exp' => time() + self::EXP,
        ];
        $this->token = JWT::encode($payload, $this->secretKey, 'HS256');
        return Curl::exec($apiMethod, $this->token , $params,$method);
    }

}
