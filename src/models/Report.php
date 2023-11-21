<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use PhpParser\Error;
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
    public function getUnique(int $id): mixed
    {
        if ($id) {
            $apiMethod = "/".$this->prefix."/{$id}";
        }
        else{
            throw new Exception('id is invalid');
        }
        $this->response = $this->getClient()->makeRequest($apiMethod);
        if(!$this->response['success']){
            throw new Exception('Ошибка API,сообщение - '.$this->response['message']);
        }
        return $this->response['report']['uniquePercent'];
    }
}
