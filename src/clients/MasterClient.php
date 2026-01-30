<?php

namespace Vkrsmart\Sdk\clients;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Http;
use Vkrsmart\Sdk\Core\Curl;

class MasterClient extends BaseClient
{
    CONST EXP = 5000000000000;


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
        $params['organization_id'] = 1;
        $this->token  = $this->getToken();

        return Curl::exec($apiMethod, $this->token , $params,$method);
    }

    public function makeFileRequest(string $apiMethod):string|false
    {
        $fullUrl = Curl::API.'/'.$apiMethod;

        $token = $this->getToken();

        $response =  Http::withHeaders([
            'Authorization' => $token,
        ])->get($fullUrl);

        if ($response->successful()) {
            return $response->body();
        }

        return false;
    }

    public function getToken(): string
    {
        $payload = [
            'exp' => time() + self::EXP,
            'organization_id' => 1
        ];
        return JWT::encode($payload, $this->masterKey, 'HS256');
    }
}