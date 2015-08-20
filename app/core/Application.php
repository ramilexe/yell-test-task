<?php

namespace yelltest\core;

use yelltest\exception\HTTPException;

class Application
{
    const MODEL_PREFIX = 'yelltest\\model\\';

    const CONTROLLER_PREFIX = 'yelltest\\controller\\';

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Controller
     */
    private $controller;

    /**
     * @var Response
     */
    private $response;


    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router();
    }

    /**
     * Запуск приложения
     *
     * @throws HTTPException
     */
    public function run()
    {
        //Парсинг URI
        $parseResult = $this->router->parseUrl($this->request->getUri());
        if ($parseResult) {
            $this->controller = $this->createController();
            $this->controller->setName($this->router->getControllerClass());
            $this->controller->setAction($this->router->getAction());
            $this->controller->setRequest($this->request);
            $this->controller->run();
        }
    }

    /**
     * Создание контроллера
     *
     * @return Controller
     * @throws HTTPException
     */
    public function createController()
    {
        $postfix = 'Controller';
        $className = self::CONTROLLER_PREFIX . $this->router->getControllerClass() . $postfix;

        if (!class_exists($className)) {
            throw new HTTPException(404, 'Class ' . $className . ' not found');
        }

        return new $className;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    public function renderResponse()
    {
        $this->response->render();
    }
}