<?php

namespace Vkrsmart\test;
use Exception;
use PHPUnit\Framework\TestCase;
use Vkrsmart\Sdk\Models\Document;
use Vkrsmart\Sdk\Models\Report;
use Vkrsmart\Sdk\Client;
class Test extends TestCase
{

    /**
     * @throws Exception
     */
    public function testUpload()
    {
        $client = new Client('0','1234');
        $document = new Document($client);
        return $document->uploadDocument('');
    }
}


