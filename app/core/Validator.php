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
            $this->errors[] = __('errors.empty email');
        } else
        {
            $emailParts = explode('@', $email);
            $localPart = $emailParts[0];
            $domainPart = $emailParts[1];
            if (count($emailParts) != 2 || empty($localPart) || empty($domainPart)) {
                $this->errors[] = __('errors.incorrect email');
            } else
            {
                $domainPart = explode('.', $domainPart);
                $subdomain = $domainPart[0];
                $tld = $domainPart[1];
                if (count($domainPart) != 2 || empty($subdomain || empty($tld))) {
                    $this->errors[] = __('errors.incorrect email');
                }
            }
        }
        return $this->errors;
    }


    /**
     * method which validate input pass
     * @param $pass
     * @return array
     */
    public function validateInputPass($pass): array
    {
        if (empty($pass))
        {
            $this->errors[] = __('errors.empty password');
        } else if(strlen($pass) > 20 || strlen($pass) < 8)
        {
            $this->errors[] = __('errors.password length');
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $pass))
        {
            $this->errors[] = __('errors.password contains');
        } else if (!preg_match('/[A-Z]/', $pass))
        {
            $this->errors[] = __('errors.password without uppercase');
        } else if (!preg_match('/[a-z]/', $pass))
        {
            $this->errors[] = __('errors.password without lowercase');
        } else if (!preg_match('/[0-9]/', $pass))
        {
            $this->errors[] = __('errors.password without numbers');
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
            $this->errors[] = __('errors.email doesn\'t exists');
        } elseif (!password_verify($user['pass'], $checkPass['pass']))
        {
            $this->errors[] = __('errors.incorrect password');
        }
        return $this->errors;
    }


}