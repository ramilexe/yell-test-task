<?php

namespace yelltest\core;


use yelltest\exception\HTTPException;

/**
 * Базовый класс контроллера
 *
 * @package yelltest\core
 */
class Controller
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Запуск контроллера
     *
     * @throws HTTPException
     */
    public function run()
    {
        $actionPrefix = 'action';
        $actionName = $actionPrefix . $this->action;

        //Нет такого экшена
        if (!method_exists($this, $actionName)) {
            throw new HTTPException(404, 'Action ' . $this->action . ' not found in class ' . get_class($this));
        }

        $this->response = new Response();

        call_user_func(array($this, $actionName));
    }

    /**
     * Выводит данные с использованием view
     *
     * @param string $viewName
     * @param array|null $data
     */
    public function render($viewName, $data = null)
    {
        $view = new View($this, $viewName, $data);
        $data =  $view->render();

        $this->response->data = $data;
        $this->response->render();
    }

    /**
     * Выводит сырые данные, без view
     *
     * @param $data
     */
    public function renderData($data)
    {
        $this->response->data = $data;
        $this->response->render();
    }
}