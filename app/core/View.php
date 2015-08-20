<?php

namespace yelltest\core;


use yelltest\exception\AppException;

class View
{
    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var string
     */
    protected $viewName;

    /**
     * @var array
     */
    protected $data;

    public function __construct(Controller $controller, $viewName, $data)
    {
        $this->basePath = dirname(__FILE__) . '/../view/' . strtolower($controller->getName()) . '/';
        $this->viewName = $viewName;
        $this->data = $data;
    }

    public function setBasePath($path)
    {
        $this->basePath = $path;
    }

    public function render()
    {
        $filePath = $this->basePath . $this->viewName . '.php';
        if (!file_exists($filePath)) {
            throw new AppException('View ' . $this->viewName . ' not found');
        }

        if ($this->data) {
            extract($this->data);
        }

        ob_start();
        require $filePath;

        return ob_get_clean();
    }
}