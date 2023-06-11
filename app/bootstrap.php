<?php
include_once '..'.DIRECTORY_SEPARATOR.'config.php';


/**
 * the same function as in the Router, but it's global and without class calling
 * @param string|null $controller
 * @param string|null $action
 * @return string
 */
function url(string|null $controller = null, string|null $action = null): string
{
    return \app\core\Router::url($controller, $action);
}


/**
 * autoloader
 */
spl_autoload_register(function ($class){

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classFile = '..'.DIRECTORY_SEPARATOR.$class . '.php';

    if (file_exists($classFile)) {
        include_once $classFile;
        return true;
    }
    return false;

});

\app\core\Router::init();