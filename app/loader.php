<?php

spl_autoload_register(function ($className) {
    //var_dump($className);

    $prefix = 'yelltest\\';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    $relativeClass = substr($className, $len);
    $file = dirname(__FILE__) . '/' . str_replace('\\', '/', $relativeClass).'.php';
    //var_dump($file);
    if (file_exists($file)) {
        require $file;
    }
});

set_exception_handler(function($exception) {
    /** @var Exception $exception */
    $response = new \yelltest\core\Response();
    $response->data = $exception->getMessage();

    if ($exception instanceof \yelltest\exception\HTTPException) {
        $response->code = $exception->getCode();
    }

    $response->render();
});