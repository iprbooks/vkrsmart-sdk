<?php

namespace Vkrsmart\Sdk\Models;

use Exception;

class Report extends Model
{


    protected string $prefix = 'report';


    /**
     * Получить report по id
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function get(int $id):bool
    {
        if ($id) {
            $apiMethod = "/".$this->prefix."/{$id}";
        }
        else{
            return false;
        }
        do{
            $this->response = $this->getClient()->makeRequest($apiMethod);
        }
        while(!$this->getValue('success'));
        return $this->getValue('success');
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
