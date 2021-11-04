<?php

// set the default timezone to use.
date_default_timezone_set('UTC');

// // classes autoloader
spl_autoload_register('classLoader');

function classLoader($class)
{
    $path = "classes/" . $class . ".php";

    if (!file_exists($path)) {
        return false;
    }

    include_once $path;
}

// load database interactions class
$db = new Database();
