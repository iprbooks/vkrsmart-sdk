<?php

namespace Vkrsmart\Sdk\Models;


use Exception;
use Illuminate\Support\Facades\File;
use PhpParser\Error;
use Vkrsmart\Sdk\clients\BaseClient;
use Vkrsmart\Sdk\clients\Client;

class Document extends Model
{
    CONST PREFIX = '/document';


    /**
     * Загрузить документ
     * @param $file
     */
    public function uploadDocument($file)
    {
        if($this->master){
            $apiMethod = '/master'.self::PREFIX.'/upload';
        }
        else{
            $apiMethod = self::PREFIX.'/upload';
        }
        $params = [
          'file' => $file
        ];
        $this->response = $this->getClient()->makeRequest($apiMethod,$params,'POST');

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
