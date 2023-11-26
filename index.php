<?php

use Application\Core\Router;
use Application\Lib\Db;
require_once "debug.php";
spl_autoload_register(function ($class)
{
    $path = str_replace('\\','/',$class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});
session_start();
$router = new Router();
$router->run();

