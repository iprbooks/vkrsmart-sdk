<?php

namespace Vkrsmart\Sdk\Models;

class Analysis extends Model
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
            $apiMethod = "/master/" . $this->prefix . "/{$id}/analysis";
        } else {
            $apiMethod = "/" . $this->prefix . "/{$id}/analysis";
        }
        $this->response = $this->getClient()->makeRequest($apiMethod, $params);
        return $this->getSuccess();
    }

    /**
     * @return false|mixed
     */
    public function getAnalysis(): mixed
    {
        return $this->getValue('analysis');
    }

    public function getCharacters()
    {
        return $this->response['analysis']['сharacters'];
    }

    public function getProposals()
    {
        return $this->response['analysis']['proposals'];
    }

}