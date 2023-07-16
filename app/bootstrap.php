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

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('error_log', '../error.log');

date_default_timezone_set('Europe/Kiev');

function __($string = '', $locale = 'ua') //TODO перенести в класс
{
    if (!empty($_SESSION['locale']))
    {
        $locale = $_SESSION['locale'];
    }

    $file = '../public/locale/' . $locale . '.php';
    $strings = [];
    if (file_exists($file))
    {
        $strings = include $file;
    }

    $categories =
        [
           'buttons.'=>$strings['buttons'] ?? [],
           'errors.'=>$strings['errors'] ?? [],
           'inputs.'=>$strings['inputs'] ?? [],
            'common.'=>$strings['common'] ?? [],
            'other.'=>$strings['other'] ?? [],
        ] ;

    $category = '';
    $key = '';

    if (str_starts_with($string, 'buttons.'))
    {
        $category = 'buttons.';
        $key = substr($string, 8);
    } elseif (str_starts_with($string, 'errors.'))
    {
        $category = 'errors.';
        $key = substr($string, 7);
    } elseif (str_starts_with($string, 'inputs.'))
    {
        $category = 'inputs.';
        $key = substr($string, 7);
    } elseif (str_starts_with($string, 'common.'))
    {
        $category = 'common.';
        $key = substr($string, 7);
    } elseif (str_starts_with($string, 'other.'))
    {
        $category = 'other.';
        $key = substr($string, 6);
    }

    if (!empty($category) && !empty($key) && isset($categories[$category][$key]))
    {
        return $categories[$category][$key];
    }

    return $string;
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


/**
 * script init
 */
\app\core\Router::init();