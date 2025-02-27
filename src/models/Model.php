<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\clients\BaseClient;
use Vkrsmart\Sdk\clients\Client;


abstract class Model
{

    protected string $prefix = '';

    /*
     * Инстанс клиента
     */
    private BaseClient $client;

    /*
     * Ответ
     */
    protected $response;

    /*
     * Данные ответа
     */

    protected bool $master;


    /**
     * Конструктор Model
     * @param BaseClient $client
     * @param bool $master
     */
    public function __construct(BaseClient $client,bool $master)
    {
        $this->client = $client;
        $this->master = $master;
    }

    public function getClient(): BaseClient
    {
        return $this->client;
    }

    public function getMessage()
    {
        return $this->getValue('message');
    }

    public function getSuccess()
    {
        return $this->getValue('success');
    }

    /**
     * @param string $value
     * @return false|mixed
     */
    public function getValue(string $value): mixed
    {
        if(is_array($this->response) && array_key_exists($value,$this->response) && $this->response[$value]!=null){
            return $this->response[$value];
        }
        else{
            return false;
        }
    }




}
