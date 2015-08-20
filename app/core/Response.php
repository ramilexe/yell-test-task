<?php

namespace yelltest\core;


class Response
{
    /**
     * Код ответа
     *
     * @var int
     */
    public $code = 200;

    /**
     * Данные
     * @var string
     */
    public $data;

    /**
     * HTTP-заголовки
     *
     * @var array
     */
    protected $headers = array();

    /**
     * Установка HTTP-заголовка
     *
     * @param string $key
     * @param string $value
     */
    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Отдача ответа сервера
     */
    public function render()
    {
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
        header(' ', true, $this->code);
        echo $this->data;
    }
}