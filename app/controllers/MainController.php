<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{
    public function index(): void
    {
        $this->view->render('start_page');
    }
}