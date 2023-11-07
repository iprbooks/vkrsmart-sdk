<?php

namespace Vkrsmart\Sdk\collections;

use Exception;
use Vkrsmart\Sdk\Client;
use Vkrsmart\Sdk\Models\Document;
use Vkrsmart\Sdk\Core\Collection;

class DocumentQueue extends Collection
{

    /*
     * Фильтрация по заглавию
     */
    const TITLE = 'title';

    /*
     * Фильтрация по издательству
     */
    const PUBHOUSE = 'pubhouse';

    /*
     * Фильтрация по авторам
     */
    const AUTHOR = 'author';

    /*
     * Ограничение года издания слева
     */
    const YEAR_LEFT = 'year_left';

    /*
     * Ограничение года издания слева
     */
    const YEAR_RIGHT = 'year_right';


    private string $apiMethod = '/2.0/resources/books/';


    /**
     * Конструктор DocumentQueue
     * @param Client $client
     * @return DocumentQueue
     * @throws Exception
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        return $this;
    }

    /**
     * Возвращает метод api
     * @return string
     */
    protected function getApiMethod(): string
    {
        return $this->apiMethod;
    }

    /**
     * Проверка значений фильтра
     * @param $field
     * @return boolean
     */
    protected function checkFilterFields($field): bool
    {
        if ($field == self::TITLE || $field == self::PUBHOUSE || $field == self::AUTHOR
            || $field == self::YEAR_LEFT || $field == self::YEAR_RIGHT) {
            return true;
        }
        return false;
    }

    /**
     * Возвращает элемент выборки
     * @param $index
     * @return Document
     * @throws Exception
     */
    public function getItem($index): Document
    {
        parent::getItem($index);
        $response = $this->createModelWrapper($this->data[$index]);
        return new Document($this->getClient(), $response);
    }
}