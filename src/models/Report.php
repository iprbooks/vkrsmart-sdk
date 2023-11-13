<?php

namespace Vkrsmart\Models;

use Exception;
use Vkrsmart\Client;

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