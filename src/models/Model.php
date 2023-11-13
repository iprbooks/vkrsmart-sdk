<?php

namespace Vkrsmart\Models;

use Exception;
use Vkrsmart\Client;

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

    /**
     * Отправка запроса
     * @param int $id
     * @return array|false|mixed|string
     * @throws Exception
     */
    public function get(int $id)
    {
        if ($id) {
            $apiMethod = "/".$this->prefix."/{$id}";
        }
        else{
            throw new Exception('id is invalid');
        }
        return $this->getClient()->makeRequest($apiMethod, array());
    }


}