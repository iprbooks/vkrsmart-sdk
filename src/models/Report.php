<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;
use Vkrsmart\Sdk\logs\Log;

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
    public function getUnique(int $id)
    {
        if ($id) {
            $apiMethod = "/".$this->prefix."/{$id}";
        }
        else{
            throw new Exception('id is invalid');
        }
        while (!$this->response['success']){
           $this->response = $this->getClient()->makeRequest($apiMethod,[]);
           Log::debug("Response = ".json_encode($this->response));
           sleep(20);
        }
        return $this->response['report']['uniquePercent'];
    }
}