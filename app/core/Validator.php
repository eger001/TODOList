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
            //TODO validation with db
        }

        //TODO react to two validation in one time
        return $this->errors;
    }


    public function validatePass($pass): array
    {
        if (empty($pass))
        {
            $this->errors[] = 'Password cannot be empty';
        } else if(strlen($pass) > 20 || strlen($pass) < 8)
        {
            $this->errors[] = 'Password must be at least 8 characters and not more than 20';
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $pass))
        {
            $this->errors[] = 'The password can only contain numbers and Latin letters';
        } else if (!preg_match('/[A-Z]/', $pass))
        {
            $this->errors[] = 'Password must contain at least one uppercase letter';
        } else if (!preg_match('/[a-z]/', $pass))
        {
            $this->errors[] = 'Password must contain at least one lowercase letter';
        } else if (!preg_match('/[0-9]/', $pass))
        {
            $this->errors[] = 'Password must contain at least one number';
        }
        return $this->errors;
    }
}