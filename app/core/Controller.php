<?php

namespace app\core;

use app\interfaces\Indexable;

abstract class Controller implements Indexable
{
    protected View $view;
    protected Model $model;

    public function __construct($template = null)
    {
        $this->view = new View($template);
        $this->model = new Model();
    }

    abstract public function index();
}