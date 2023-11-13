<?php

namespace Vkrsmart\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use \Vkrsmart\Client;
use Vkrsmart\logs\Log;
use \Vkrsmart\Models\Document;

class Test extends TestCase
{

    /**
     * @throws Exception
     */
    public function testUpload()
    {
        $client = new Client('0','1234');
        $document = new Document($client);
        Log::debug($document->uploadDocument("C:\\Users\\iprsm\\Downloads\\197421952.pdf"));
    }


}


