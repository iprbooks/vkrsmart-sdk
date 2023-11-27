<?php

namespace Vkrsmart\Sdk\Models;


use Exception;
use Illuminate\Support\Facades\File;
use PhpParser\Error;
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
     * Загрузить документ
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
        return $this->response['success'];
    }

    /**
     * @return false|mixed
     */
    public function getId(): mixed
    {
        return $this->getValue('document_id');
    }





}
