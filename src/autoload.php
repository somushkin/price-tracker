<?php

spl_autoload_register(function ($class) {

    $class = str_replace('App\\', '', $class);
    $filename = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($filename)) {
        require_once $filename;
    }

});