<?php

namespace yelltest\model;

/**
 * Класс для формирования ответа в виде JSON
 *
 * @package yelltest\model
 */
class JsonWriter extends Writer
{
    public function process($data)
    {
        $this->response->setHeader('Content-Type', 'application/json');

        return json_encode($data);
    }
}