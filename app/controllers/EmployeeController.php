<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Session;
use app\models\EmployeeModel;

class EmployeeController extends Controller
{

    public function __construct($template = null)
    {
        parent::__construct($template);
        $this->model = new EmployeeModel();
    }

    public function index(): void
    {
        $this->all();
        $employees = Session::all('employees');
        $this->view->render('employees_index',
            [
                'employees'=>$employees,
            ]);
    }

    private function all(): void
    {
        $employees = $this->model->getAllEmployees();
        Session::save('employees', $employees);
    }
}