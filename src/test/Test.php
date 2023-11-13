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
        Log::debug(implode(',',$document->uploadDocument("C:\\Users\\iprsm\\Downloads\\197421952.pdf")));
    }

    /**
     * @throws Exception
     */
    public function testGetReport(){
        $documentId = 463228;
        $client = new Client('0','1234');
        $report = new Report($client);
        Log::debug(implode(',',$report->get($documentId)));
    }


}


