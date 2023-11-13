<?php

namespace Vkrsmart;


use Exception;
use Firebase\JWT\JWT;
use Vkrsmart\Core\Curl;
use Vkrsmart\logs\Log;

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
     * @return array|false|mixed|string
     * @throws Exception
     */
    public function makeRequest($apiMethod, array $params, string $method="GET")
    {
        $payload = [
            "organization_id" => $this->organisationId,
            'iat' => time(),
            'exp' => time() + self::EXP,
        ];
        $token = JWT::encode($payload, $this->secretKey, 'HS256');
//        $params = array_merge(["organisation_id" => $this->organisationId], $params);

        Log::debug("Organisation id = $this->organisationId,secret key = $this->secretKey,token = $token");
        return Curl::exec($apiMethod, $token, $params,$method);
    }

}
