<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 19.08.15
 * Time: 23:51
 */

namespace yelltest\core;


class Request
{
    /**
     * HTTP GET data
     *
     * @var array
     */
    private $getData;

    /**
     * HTTP POST data
     *
     * @var array
     */
    private $postData;

    /**
     * Server variables
     *
     * @var array
     */
    private $serverData;

    /**
     * Cookie from HTTP request
     *
     * @var array
     */
    private $cookieData;

    public function __construct()
    {
        $this->getData = $_GET;
        $this->postData = $_POST;
        $this->serverData = $_SERVER;
        $this->cookieData = $_COOKIE;
    }

    public function getUri()
    {
        return (isset($this->serverData['REQUEST_URI']) ? $this->serverData['REQUEST_URI'] : null);
    }

    /**
     * @param string $key Ключ GET-массива
     * @return mixed
     */
    public function getQuery($key)
    {
        return (isset($this->getData[$key]) ? $this->getData[$key] : null);
    }
}