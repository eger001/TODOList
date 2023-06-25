<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\core\Session;
use app\interfaces\Changeable;
use JetBrains\PhpStorm\NoReturn;

class LocaleController implements Changeable
{
    #[NoReturn] public function change(): void
    {
        $localeData = filter_input_array(INPUT_POST)['locale'];
        if (!empty($localeData))
        {
            Session::setLocale($localeData);
        }
        Router::goBack();
    }
}