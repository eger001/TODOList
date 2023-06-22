<?php

namespace app\core;

use app\interfaces\Indexable;
use app\traits\UserInputData;

abstract class Controller implements Indexable
{

    use UserInputData;
    protected View $view;
    protected Model $model;
    protected Validator $validator;

    public function __construct($template = null)
    {
        $this->view = new View($template);
        $this->model = new Model();
        $this->validator = new Validator();
    }

    abstract public function index();
}