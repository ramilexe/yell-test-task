<?php

namespace yelltest\model;


use yelltest\exception\AppException;

abstract class Shape implements DrawInterface
{
    /**
     * Массив параметров фигуры
     * @var array
     */
    protected $params;

    /**
     * Массив обязательных параметров
     *
     * @var array
     */
    protected $requiredParams;

    public function setParams($params)
    {
        foreach ($this->requiredParams as $param) {
            if (!isset($params[$param])) {
                throw new AppException('Не указан обязательный параметр ' . $param);
            }
        }

        $this->params = $params;
    }

    public function __get($key)
    {
        return (isset($this->params[$key]) ? $this->params[$key] : null);
    }

    public function __set($key, $value)
    {
        $this->params[$key] = $value;
    }
}