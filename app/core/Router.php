<?php

namespace app\core;

use app\interfaces\Indexable;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    const CONTROLLER_NAMESPACE = 'app\controllers\\';
    const CONTROLLER_SUFFIX = 'Controller';
    const BASE_ROUTE_NAME = 'index';


    /**the main function initiated all script
     * @return void
     */
    public static function init(): void
    {
        session_start();

        $requestURI = $_SERVER['REQUEST_URI'];
        $requestURIWithoutGETPath = explode('?', $requestURI)[0];

        $pathComponents = explode('/', $requestURIWithoutGETPath);
        $pathComponents = array_slice($pathComponents, 1);

        $controllerName = self::BASE_ROUTE_NAME;
        if (!empty($pathComponents[0]))
        {
            $controllerName = strtolower($pathComponents[0]);
        }

        $actionName = self::BASE_ROUTE_NAME;
        if (!empty($pathComponents[1]))
        {
            $actionName = strtolower($pathComponents[1]);
        }

        $controllerClass = self::CONTROLLER_NAMESPACE.ucfirst($controllerName).self::CONTROLLER_SUFFIX;

        if (!class_exists($controllerClass))
        {
            self::notFound();
        }
        $controller = new $controllerClass();

        if (!method_exists($controller, $actionName))
        {
            self::notFound();
        }

        self::callAction($controller, $actionName);
    }


    /**
     * notFound function redirecting to 404 page
     * @return void
     */
    #[NoReturn] private static function notFound():void
    {
        http_response_code(404);
        exit();
    }


    /**
     * calling action of the route
     * @param Indexable $controller
     * @param string $actionName
     * @return void
     */
    private static function callAction(Indexable $controller, string $actionName): void
    {
        $controller->$actionName();
    }
}