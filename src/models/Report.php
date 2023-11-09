<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;

class Report extends Model
{
    CONST PREFIX = '/report';

    /**
     * Конструктор Report
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
    }
}