<?php

namespace app\traits;

use app\controllers\UserController;
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
        $user = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']))
        {
            if ($_POST['csrf_token'] === $_SESSION['csrf_token'])
            {
                $user = filter_input_array(INPUT_POST,
                    [
                        'email' => FILTER_DEFAULT,
                        'pass' => FILTER_DEFAULT,
                    ]);
            }
        } else
        {
            http_response_code(404);
            exit();
        }

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
        $errors = $this->validator->validateInputPass($user['pass']);
        if (count($errors)>0)
        {
            Session::save('authorization', $errors);
            Router::goBack();
        }
    }


    /**
     * @throws \Exception
     */
    private function pushToken(): void
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
    }


    /**
     * @return array
     * @throws \Exception
     */
    protected function authorizationAlgo() :array
    {
        $user = $this->getUserInputData();
        $this->checkUserData($user);
        $this->pushToken();
        return $user;
    }


    /**
     * save user id in the session
     * @param $userId
     * @return void
     */
    protected function userIDtoSession($userId):void
    {
        Session::save('user_id', $userId);
    }
}