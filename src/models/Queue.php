<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;
use Vkrsmart\Sdk\Core\Model;

class Queue extends Model
{
    //Уточнить у Камиля полный путь
    private string $apiMethod = '';

    /**
     * Возвращает метод апи для вызова
     */
    protected function getApiMethod(): string
    {
        return $this->apiMethod;
    }
    public function uploadDocument(string $filePath){
        $file = fopen($filePath,'r');
        if(!$file){
            return false;
        }
        return json_encode(['success'=>true,'file'=>$file]);


    }
}