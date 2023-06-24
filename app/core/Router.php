<?php

namespace app\core;

use app\interfaces\Indexable;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    const CONTROLLER_NAMESPACE = 'app\controllers\\';
    const CONTROLLER_SUFFIX = 'Controller';
    const BASE_CONTROLLER_NAME = 'user';
    const BASE_ACTION_NAME = 'index';


    /**the main function initiated all script
     * @return void
     * @throws \Exception
     */
    public static function init(): void
    {
        $sessionDuration = 30 * 24 * 60 * 60;
        session_set_cookie_params($sessionDuration);
        session_start();
        if (!isset($_SESSION['user_id']))
        {
            url('authorization', 'logout');
        }

        if (!isset($_SESSION['locale']))
        {
            $_SESSION['locale'] = 'ua';
        }

        if (!isset($_SESSION['csrf_token']))
        {
            $token = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $token;
        }

        $requestURI = $_SERVER['REQUEST_URI'];
        $requestURIWithoutGETPath = explode('?', $requestURI)[0];

        $pathComponents = explode('/', $requestURIWithoutGETPath);
        $pathComponents = array_slice($pathComponents, 1);

        $controllerName = self::BASE_CONTROLLER_NAME;
        if (!empty($pathComponents[0]))
        {
            $controllerName = strtolower($pathComponents[0]);
        }

        $actionName = self::BASE_ACTION_NAME;
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


    /**
     * @param string|null $controller
     * @param string|null $action
     * @return string
     */
    public static function url(string|null $controller = null, string|null $action = null): string
    {
        $controller = $controller ?? 'user';
        $action = $action ?? 'index';
        return "/{$controller}/{$action}";
    }


    /**
     * @param string $controller
     * @param string $action
     * @return void
     */
    #[NoReturn] public static function redirect(string $controller, string $action): void
    {
        header('Location: '.self::url($controller, $action));
        exit();
    }


    /**
     * the same as a redirect but return user to the previous page
     * @return void
     */
    #[NoReturn] public static function goBack(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? null;
        if (!$referer)
        {
            header('Location: /');
            exit();
        }
        header('Location: '.$referer);
        exit();
    }
}