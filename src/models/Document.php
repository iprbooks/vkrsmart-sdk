<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;
use Vkrsmart\Sdk\Core\Model;

class Document extends Model
{
    //Уточнить у Камиля полный путь
    private string $apiMethod = '';


    /**
     * Конструктор Document
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
        return $this;
    }

    /**
     * Возвращает метод апи для вызова
     */
    protected function getApiMethod(): string
    {
        return $this->apiMethod;
    }
     public function upload(string $filePath){
        $file = fopen($filePath,'r');
        if(!$file){
            return false;
        }
        return json_encode(['success'=>true,'file'=>$file]);
    }

}