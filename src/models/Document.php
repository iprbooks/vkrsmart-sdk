<?php

namespace Vkrsmart\Sdk\Models;


use Exception;
use Illuminate\Support\Facades\File;
use PhpParser\Error;
use Vkrsmart\Sdk\clients\Client;

class Document extends Model
{
    CONST PREFIX = '/document';


    /**
     * Загрузить документ
     * @param $file
     * @return bool
     */
    public function uploadDocument($file): bool
    {
        $apiMethod = self::PREFIX.'/upload';
        $params = [
          'file' => $file
        ];
        $this->response = $this->getClient()->makeRequest($apiMethod,$params,'POST');
        return $this->response['success'];
    }

    /**
     * Получить текст документа
     * @param int $documentId
     * @return bool
     */
    public function getText(int $documentId): bool
    {
        $apiMethod = self::PREFIX.'/'.$documentId;
        $this->response = $this->getClient()->makeRequest($apiMethod,[]);
        return $this->getValue('success');
    }




    /**
     * @return false|mixed
     */
    public function getId(): mixed
    {
        return $this->getValue('document_id');
    }





}
