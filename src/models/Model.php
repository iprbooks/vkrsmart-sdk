<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\clients\Client;


abstract class Model
{
    protected string $prefix = '';

    /*
     * Инстанс клиента
     */
    private Client $client;

    /*
     * Ответ
     */
    protected $response;

    /*
     * Данные ответа
     */
    protected array $data;




    /**
     * Конструктор Model
     * @param Client $client
     * @param $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        if (!$client) {
            throw new Exception('client is not init');
        }
        $this->client = $client;
        $this->response = $response;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getMessage()
    {
        return $this->getValue('message');
    }

    /**
     * @param string $value
     * @return false|mixed
     */
    public function getValue(string $value): mixed
    {
        if(array_key_exists($value,$this->response) and $this->response[$value]!=null){
            return $this->response[$value];
        }
        else{
            return false;
        }
    }



}
