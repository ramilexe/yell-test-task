<?php

namespace yelltest\model;


use yelltest\core\Response;

abstract class Writer
{
    /**
     * @var Response
     */
    protected $response;

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    abstract public function process($data);
}