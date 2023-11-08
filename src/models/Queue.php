<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;

class Queue extends Model
{
    /**
     * Конструктор Queue
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
        $this->domain = $this->domain.'/queue';
        return $this;
    }
    /**
     * @throws Exception
     */
    public function uploadDocument(string $filePath){
        $apiMethod = $this->domain.'/upload';
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