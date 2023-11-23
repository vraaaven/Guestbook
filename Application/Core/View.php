<?php

namespace Application\Core;
class View
{

    public $layout = 'default';


    public function render($view,$vars = [])
    {
        extract($vars);
        if (file_exists('Application/Views/'.$view.'.php'))
        {
            ob_start();
            require 'Application/Views/'.$view.'.php';
            $content = ob_get_clean();
            require 'Application/Views/Layouts/'.$this->layout.'.php';
        }
        else
        {
            echo 'вид не найден';
        }
    }
    public static function errorCode($code)
    {
        http_response_code($code);
        require 'Application/Views/Errors/'.$code.'.php';
        exit;
    }
    public function redirect($url)
    {
        header('location'.$url);
        exit;
    }
}