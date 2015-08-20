<?php

namespace yelltest\exception;

/**
 *
 * Class HTTPException
 * @package yelltest\exception
 */
class HTTPException extends \Exception
{
    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

}