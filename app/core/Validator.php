<?php

namespace app\core;

use app\models\UserModel;
use mysql_xdevapi\Session;

class Validator
{
    protected Session $session;
    protected UserModel $model;

    public array $errors = [];

    public function __construct()
    {
        $this->model = new UserModel();
//        $this->session = new Session();
    }

    public function validateUserEmail($email): array
    {
        if (empty($email)) {
            $this->errors[] = 'Email cannot be empty';
        }

        $emailParts = explode('@', $email);
        if (count($emailParts) != 2 || empty($emailParts[0] || empty($emailParts[1]))) {
            $this->errors[] = 'Incorrect email';
        } else
        {
            $emailParts[1] = explode('.', $emailParts[1]);
            if (count($emailParts[1]) != 2 || empty($emailParts[1][0] || empty($emailParts[1][1]))) {
                $this->errors[] = 'Incorrect email';
            }
        }
        return $this->errors;
    }
}