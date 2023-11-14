<?php

namespace Vkrsmart\Models;

use Exception;
use Vkrsmart\Client;

class Report extends Model
{
    protected string $prefix = 'report';

    /**
     * Конструктор Report
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
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
            $apiMethod = "/".$this->prefix."/$id";
        }
        else{
            throw new Exception('id is invalid');
        }
        return $this->getClient()->makeRequest($apiMethod, array());
    }
}