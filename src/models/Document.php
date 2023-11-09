<?php

namespace Vkrsmart\Sdk\Models;


use Exception;
use Vkrsmart\Sdk\Client;

class Document extends Model
{
    CONST PREFIX = '/document';

    /**
     * Конструктор Document
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
    }


    /**
     * @param string $filePath
     * @return array|mixed
     * @throws Exception
     */
    public function uploadDocument(string $filePath){
        $apiMethod = self::PREFIX.'/upload';
        $file = fopen($filePath,'r');
        if(!$file){
            throw new Exception('File not found');
        }
        $params = [
          'file_path' => $filePath
        ];
        return $this->getClient()->makeRequest($apiMethod,$params);
    }

}