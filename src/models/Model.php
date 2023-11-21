<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;


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



}