<?php

namespace yelltest\core;
use yelltest\exception\AppException;

/**
 * Парсит URI
 *
 * @package yelltest\core
 */
class Router
{
    const DEFAULT_CONTROLLER = 'Default';
    const DEFAULT_ACTION = 'Index';

    /**
     * Имя класса-контроллера
     * @var string
     */
    protected $controllerClass;

    /**
     * Название action'а
     * @var string
     */
    protected $action;


    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    public function getAction()
    {
        return $this->action;
    }

    /**
     * Парсинг запроса
     * URI имеет формат
     * /controller/action?params1=value1&param2=value2
     *
     * @param string $uri
     * @return bool
     */
    public function parseUrl($uri)
    {
        //Избавляем от GET-переменных в строке
        $uri = parse_url($uri, PHP_URL_PATH);

        $uri = ltrim($uri, '/');

        if ($uri == "") {
            $this->controllerClass = self::DEFAULT_CONTROLLER;
            $this->action = self::DEFAULT_ACTION;

            return true;
        }

        $data = explode('/', $uri);

        //есть controller
        if (isset($data[0])) {
            $this->controllerClass = ucfirst($data[0]);
            //есть action
            if (isset($data[1])) {
                $this->action = ucfirst($data[1]);
            }
        }

        return $this->validate();
    }

    /**
     * @return bool
     * @throws AppException
     */
    private function validate()
    {
        if (!preg_match('|[\w]+|', $this->controllerClass)) {
            throw new AppException($this->controllerClass.' not valid');
        }

        return true;
    }
}