<?php

namespace Vkrsmart\Sdk\Models;

use Exception;
use Vkrsmart\Sdk\Client;
use Vkrsmart\Sdk\Core\Model;

class Report extends Model
{
    private string $apiMethod = '';

    /**
     * Конструктор Report
     * @param Client $client
     * @param null $response
     * @throws Exception
     */
    public function __construct(Client $client, $response = null)
    {
        parent::__construct($client, $response);
        return $this;
    }

    protected function getApiMethod(): string
    {
        return $this->apiMethod;
    }




}