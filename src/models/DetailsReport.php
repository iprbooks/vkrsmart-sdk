<?php

namespace Vkrsmart\Sdk\Models;

class DetailsReport extends Model
{

    protected string $prefix = 'report';


    /**
     * Получить report по id
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function get(int $id, array $params = []): bool
    {
        if ($this->master) {
            $apiMethod = "/master/" . $this->prefix . "/{$id}/details";
        } else {
            $apiMethod = "/" . $this->prefix . "/{$id}/details";
        }
        $this->response = $this->getClient()->makeRequest($apiMethod, $params);
        return $this->getSuccess();
    }

    /**
     * @return false|mixed
     */
    public function getDetails(): mixed
    {
        return $this->getValue('details');
    }



}