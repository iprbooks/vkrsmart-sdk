<?php

namespace Vkrsmart\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Vkrsmart\Client;
use Vkrsmart\logs\Log;
use Vkrsmart\Models\Document;
use Vkrsmart\Models\Report;

class Test extends TestCase
{
    public string $file1 =  'C:\Users\iprsm\Downloads\barenkova_oforml_kr.pdf';

    public array $files = ['C:\Users\iprsm\Downloads\barenkova_oforml_kr.pdf','C:\Users\iprsm\Downloads\197421952.pdf','C:\Users\iprsm\Downloads\52c8e8114c11cfa9e6e668ee652dbf2b.pdf'];

    /**
     * @throws Exception
     */
    public function testDocument()
    {
        $client = new Client('0','1234');
        $document = new Document($client);
        $documentId = $document->uploadDocument('C:\Users\iprsm\Downloads\barenkova_oforml_kr.pdf');
        Log::debug("Document id = $documentId");
        $report = new Report($client);
        $unique = $report->getUnique($documentId);
        return $unique;
    }

    /**
     * @throws Exception
     */
    public function testDocuments(){
         $client = new Client('0','1234');
         $document = new Document($client);
         $documentIds = $document->uploadDocuments($this->files);
         $report = new Report($client);
         $unique = $report->getUnique($documentIds[0]);
         return $unique;
    }




}


