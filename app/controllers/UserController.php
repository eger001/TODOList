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
     */
    #[NoReturn] public function store():void
    {
        $this->model->add($this->authorizationAlgo());

        Router::redirect('user','index');
    }
}