<?php

namespace app\traits;

use app\core\Router;
use app\core\Session;
use app\models\UserModel;

trait UserInputData
{

    /**
     * get all user input data on the authorization page
     * @return array
     */
    private function getUserInputData(): array
    {
        $user = filter_input_array(INPUT_POST,
            [
                'email' => FILTER_DEFAULT,
                'pass' => FILTER_DEFAULT,
            ]);
        return $user;
    }


    /**
     * check input data to their valid
     * @param $user
     * @return void
     */
    private function checkUserData($user): void
    {
        $errors = $this->validator->validateInputEmail($user['email']);
        if (count($errors)>0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
        $errors = $this->validator->validateInputPass($user['pass'], $user['email']);
        if (count($errors)>0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
    }


    /**
     * save user id in the session
     * @param $userId
     * @return void
     */
    protected function userIDtoSession($userId):void
    {
        $_SESSION['user_id'] = $userId;
    }


    /**
     * @return array
     */
    protected function authorizationAlgo() :array
    {
        $user = $this->getUserInputData();
        $this->checkUserData($user);
        return $user;
    }
}