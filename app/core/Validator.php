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


    /**
     * method which validate  input email
     * @param $email
     * @return array
     */
    public function validateInputEmail($email): array
    {
        if (empty($email)) {
            $this->errors[] = 'Email cannot be empty';
        } else
        {
            $emailParts = explode('@', $email);
            $localPart = $emailParts[0];
            $domainPart = $emailParts[1];
            if (count($emailParts) != 2 || empty($localPart) || empty($domainPart)) {
                $this->errors[] = 'Incorrect email';
            } else
            {
                $domainPart = explode('.', $domainPart);
                $subdomain = $domainPart[0];
                $tld = $domainPart[1];
                if (count($domainPart) != 2 || empty($subdomain || empty($tld))) {
                    $this->errors[] = 'Incorrect email';
                }
            }
        }
        return $this->errors;
    }


    /**
     * method which validate input pass
     * @param $pass
     * @param $user
     * @return array
     */
    public function validateInputPass($pass, $user): array
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


    /**
     * method which validate user input data with their data in the DB
     * @param $user
     * @return array
     */
    public function validateUserData($user): array
    {
        $checkPass = $this->model->get($user['email']);
        if (empty($checkPass))
        {
            $this->errors[] = 'This email is not exists';
        } elseif (!password_verify($user['pass'], $checkPass['pass']))
        {
            $this->errors[] = 'Password is incorrect';
        }
        return $this->errors;
    }


}