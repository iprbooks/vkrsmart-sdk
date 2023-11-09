<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;

class Queue extends Model
{
    CONST PREFIX = '/queue';
    /**
     * Конструктор Queue
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
    public function uploadDocument(string $filePath)
    {
        $apiMethod = '/upload';
        $file = fopen($filePath,'r');
        if(!$file){
            throw new Exception('File not found');
        }
        $params = [
            'file_path' => $filePath
        ];
        return $this->getClient()->makeRequest($apiMethod,$params);
    }

    /**
     * @param string $url
     * @return array|mixed
     */
    public function uplouadByUrl(string $url)
    {
        $apiMethod = $this->domain."/$url";
        return $this->getClient()->makeRequest($apiMethod);
    }

}