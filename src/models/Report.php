<?php

namespace Vkrsmart\Sdk\Models;

use Exception;

class Report extends Model
{


    protected string $prefix = 'report';


    /**
     * Получить report по id
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function get(int $id,array $params = []):bool
    {
        if($this->master){
            $apiMethod = "/master/".$this->prefix."/{$id}";
        }
        else{
            $apiMethod = "/".$this->prefix."/{$id}";
        }
        $i = 0;
        do{
            $this->response = $this->getClient()->makeRequest($apiMethod,$params);
            sleep(5);
            $i++;
        }
        while(!$this->getSuccess() and $i<2000);
        $this->response = $this->getClient()->makeRequest($apiMethod);
        return $this->getSuccess();
    }

    /**
     * @return false|mixed
     */
    public function getReport(): mixed
    {
        return $this->getValue('report');
    }

    public function getUnique():mixed
    {
        return $this->response['report']['uniquePercent'];
    }
    public function toString(): string
    {
        $report = $this->getReport();
        $documents = $report['sourceDocuments'];
        $unique = floor($report['uniquePercent'])."%";
        $response = "Уникальность работы - ".$unique."\nЗаимствованные документы:";
        $i = 1;
        foreach ($documents as $document)
        {
            $response.="\n\n".$i++.") Название - ".$document['title'];
            $percent = floor($document['percent']);
            $response.="\nПроцент заимствований - ".$percent."%";
            $response.="\nСсылка на документ - ".$document['link'];
        }
        return $response;
    }

}
