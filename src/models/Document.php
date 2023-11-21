<?php

namespace Vkrsmart\Sdk\Models;


use Exception;
use PhpParser\Error;
use Vkrsmart\Sdk\Client;
use Vkrsmart\Sdk\logs\Log;

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
     * @param $file
     * @return array|mixed
     * @throws Exception
     */
    public function uploadDocument($file): mixed
    {
        $apiMethod = self::PREFIX.'/upload';
        $params = [
          'file' => $file
        ];
        $this->response = $this->getClient()->makeRequest($apiMethod,$params,'POST');
        if(!$this->response['success']){
            throw new Error('Ошибка API,сообщение - '.$this->response['message']);
        }
        return $this->response['document_id'];
    }

//    /**
//     * @param mixed ...$filePaths
//     * @return array|mixed
//     * @throws Exception
//     */
//    public function uploadDocuments(...$filePaths){
//        foreach ($filePaths as $filePath){
//            $this->documentIds = $this->uploadDocument($filePath);
//        }
//        return $this->documentIds;
//    }



}
