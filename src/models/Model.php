<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;

abstract class Model
{
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

    protected string $domain = 'api-link';


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
        return $this;
    }


    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Отправка запроса
     * @param int $id
     * @throws Exception
     */
    public function get(int $id)
    {
        if ($id) {
            $apiMethod = $this->domain."get/{$id}";
        }
        else{
            throw new Exception('id invalid');
        }
        $this->response = $this->getClient()->makeRequest($apiMethod, array());
        if (array_key_exists('data', $this->response)) {
            $this->data = $this->response['data'];
        }
        else {
            $this->data = array();
        }
    }


}