<?php

namespace Vkrsmart\Sdk\Models;

use Exception;

class Report extends Model
{


    protected string $prefix = 'report';
    
    protected $report;


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

        if(is_array($this->response) && array_key_exists('report',$this->response))
        {
            $this->report = $this->response['report'];
            return $this->getSuccess();
        }

        return false;
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
        return round($this->report['uniquePercent']);
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

    public function getDocuments(bool $limitDocuments=false)
    {
        $sourceDocuments =  $this->getReportValue('sourceDocuments');

        if ($sourceDocuments)
        {
            usort($sourceDocuments, function ($a, $b) {
                return $b['borrowingPercent'] <=> $a['borrowingPercent'];
            });

            if($limitDocuments)
            {
                // Оставляем только первые 5 элементов
                $sourceDocuments = array_slice($sourceDocuments, 0, 5);
            }

        }

        return $sourceDocuments;
    }

    public function getReportValue(string $value):mixed
    {
        if(is_array($this->report) && array_key_exists($value,$this->report) && $this->report[$value]!=null)
        {
            return $this->report[$value];
        }
        else
        {
            return false;
        }
    }
    
    

}
