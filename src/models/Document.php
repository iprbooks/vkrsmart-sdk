<?php

namespace Vkrsmart\Models;


use Exception;
use Vkrsmart\Client;
use Vkrsmart\logs\Log;

class Document extends Model
{
    CONST PREFIX = '/document';

    private array $documentIds;

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
        $this->response = $this->getClient()->makeRequest($apiMethod,$params,'POST');
        return $this->response['document_id'];
    }

    /**
     * @param mixed ...$filePaths
     * @return array|mixed
     * @throws Exception
     */
    public function uploadDocuments(...$filePaths){
        foreach ($filePaths as $filePath){
            $this->documentIds = $this->uploadDocument($filePath);
        }
        return $this->documentIds;
    }



}