<?php

namespace app\controllers;

use app\core\Controller;

class AuthorizationPageController extends Controller
{
    public function index(): void
    {
        $this->view->render('authorization_page');
    }
}