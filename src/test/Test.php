<?php

namespace Vkrsmart\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use \Vkrsmart\Client;
use Vkrsmart\logs\Log;
use \Vkrsmart\Models\Document;
use Vkrsmart\Models\Report;

class Test extends TestCase
{

    /**
     * @throws Exception
     */
    public function testUpload()
    {
        $client = new Client('0','1234');
        $document = new Document($client);
        Log::debug(implode(',',$document->uploadDocument("C:\\Users\\iprsm\\Downloads\\barenkova_oforml_kr.pdf")));
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testGetReport(){
        $documentId = 463233;
        $client = new Client('0','1234');
        $report = new Report($client);
        Log::debug($report->get($documentId));
    }


}


