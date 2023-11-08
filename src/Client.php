<?php

namespace Vkrsmart\Sdk;

use Exception;
use Firebase\JWT\JWT;
use Vkrsmart\Sdk\Core\Curl;

final class Client
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
     * @param $clientId
     * @param $secretKey
     * @throws Exception
     */
    public function __construct($clientId, $secretKey)
    {
        if (!is_numeric($clientId)) {
            throw new Exception('$clientId must be numeric');
        }
        $this->organisationId = $clientId;
        $this->secretKey = $secretKey;
    }

    public function makeRequest($apiMethod, array $params)
    {
        $json = array(
            "client_id" => $this->organisationId,
            'iat' => time(),
            'exp' => time() + self::EXP,
        );
        $token = JWT::encode($json, $this->secretKey, 'HS256');
        $params = array_merge(array("client_id" => $this->organisationId), $params);
        return Curl::exec($apiMethod, $token, $params);
    }


}
