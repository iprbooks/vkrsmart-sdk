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
        $this->response = $this->getClient()->makeRequest($apiMethod,$params);
        return $this->getSuccess();
    }

    /**
     * @return false|mixed
     */
    public function getReport(): mixed
    {
        $report = $this->getValue('report');

        if (isset($report['sourceDocuments']))
        {
            usort($report['sourceDocuments'], function($a, $b){
                if ($a['percent'] < $b['percent']) {
                    return -1;
                }

                if ($a['percent'] > $b['percent']) {
                    return 1;
                }
                return 0;
            });
        }

        return $this->getValue('report');
    }

    public function getUnique():mixed
    {
        return round($this->response['report']['uniquePercent']);
    }
    public function toString(): string
    {
        $report = $this->getReport();
        if($this->getUnique()==100){
            return 'В вашей работе нет заимствований';
        }
        $documents = $report['sourceDocuments'];
        $unique = round($report['uniquePercent'],5)."%";
        $response = "Уникальность работы - ".$unique."\nЗаимствованные документы:";
        $i = 1;
        foreach ($documents as $document)
        {
            if($i>10){
                $response.="\n\nОстальные заимствованные документы можно посмотреть в отчёте:";
                break;
            }
            $response.="\n\n".$i++.')'.$document['title'];
            $percent = round($document['percent'],5);
            $response.="\nПроцент заимствований - ".$percent."%";
            $response.="\nСсылка на документ - ".$document['link'];
        }
        return $response;
    }

    public function getDocuments()
    {
        $sourceDocuments =  $this->response['report']['sourceDocuments'];

        Log::debug('source documents = '.print_r($sourceDocuments,true));

        if(isset($sourceDocuments))
        {
            usort($sourceDocuments, function($a, $b){
                if ($a['borrowingPercent'] > $b['borrowingPercent']) {
                    return -1;
                }

                if ($a['borrowingPercent'] < $b['borrowingPercent']) {
                    return 1;
                }
                return 0;
            });
        }

        return $sourceDocuments;
    }

}
