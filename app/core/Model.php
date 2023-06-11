<?php

namespace app\core;

use app\database\CreateDB;

class Model
{
    protected \mysqli $db;

    public function __construct()
    {
        CreateDB::create();
    }
}