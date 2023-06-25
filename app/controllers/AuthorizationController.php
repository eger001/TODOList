<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\core\Session;
use app\models\UserModel;
use app\traits\UserInputData;
use JetBrains\PhpStorm\NoReturn;

class AuthorizationController extends Controller
{
    public function __construct($template = null)
    {
        parent::__construct($template);
        $this->model = new UserModel();
    }

    public function index()
    {
        //TODO view
    }


    /**
     * Checks if the user is logged in and performs the login operation
     * @return void
     * @throws \Exception
     */
    #[NoReturn] public function login(): void
    {
        $user = $this->authorizationAlgo();

        $errors = $this->validator->validateUserData($user);
        if (count($errors) != 0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
        $_SESSION['authorized'] = true;

        $userId = $this->model->get($user['email'])['id'];
        $this->userIDtoSession($userId);

        Router::redirect('user','index');
    }


    /**
     * Logs out the user at his request
     * @return void
     */
    #[NoReturn] public function logout():void
    {
        session_destroy();
        Router::redirect('user', 'index');
    }
}