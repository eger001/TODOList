<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\core\Session;
use app\core\Validator;
use app\models\UserModel;

class UserController extends Controller
{

    public function __construct($template = null)
    {
        parent::__construct($template);
        $this->model = new UserModel();
        $this->validator = new Validator();
    }

    public function index(): void
    {
        $errors = Session::all('authorization');
        $this->view->render('authorization',
            [
                'errors'=>$errors,
            ]);
    }

    public function store():void
    {
        $user = filter_input_array(INPUT_POST,
            [
                'email'=>FILTER_DEFAULT,
                'pass'=>FILTER_DEFAULT,
            ]
        );
        $errors = $this->validator->validateUserEmail($user['email']);
        if (count($errors)>0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
        $errors = $this->validator->validatePass($user['pass'], $user['email']);
        if (count($errors)>0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
        $this->model->add($user);
    }
}