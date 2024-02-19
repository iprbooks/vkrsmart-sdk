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
     * @param $response
     * @throws Exception
     */
    public function __construct(BaseClient $client)
    {
        $this->client = $client;
    }

    public function getClient(): BaseClient
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
