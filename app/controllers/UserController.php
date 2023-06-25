<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\core\Session;
use app\core\Validator;
use app\models\UserModel;
use app\traits\UserInputData;
use JetBrains\PhpStorm\NoReturn;

class UserController extends Controller
{
    public function __construct($template = null)
    {
        parent::__construct($template);
        $this->model = new UserModel();
    }

    public function index(): void
    {
        $errors = Session::all('authorization');
        $this->view->render('start_page',
            [
                'errors'=>$errors,
            ]);
    }


    /**
     * method which store new user in DB and use a trait methods
     * @return void
     * @throws \Exception
     */
    #[NoReturn] public function store():void
    {
        $user = $this->authorizationAlgo();
        $errors = $this->validator->validateIsEmailAvailable($user);
        if (count($errors) != 0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
        $this->model->add($user);

        $_SESSION['authorized'] = true;

        $userId = $this->model->get($user['email'])['id'];
        $this->userIDtoSession($userId);

        Router::redirect('user','index');
    }
}