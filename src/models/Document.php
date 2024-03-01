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
     * @param array $params
     * @return bool
     */
    public function uploadDocument($file,array $params = []):bool
    {
        if($this->master){
            $apiMethod = '/master'.self::PREFIX.'/upload';
        }
        else{
            $apiMethod = self::PREFIX.'/upload';
        }
        if(is_string($file)){
            $params['file_path'] = $file;
        }
        else{
            $params['file'] = $file;
        }
        $this->response = $this->getClient()->makeRequest($apiMethod,$params,'POST');
        return $this->getSuccess();

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

    public function text()
    {
        return $this->getValue('text');
    }




    /**
     * @return false|mixed
     */
    public function getId(): mixed
    {
        return $this->getValue('document_id');
    }





}
