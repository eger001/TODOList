<?php

namespace app\core;

use app\database\CreateDB;

class Model
{
    protected \mysqli $db;

    public function __construct()
    {
        //TODO validation
        $this->createDefaultDbClass();
        CreateDB::create();
    }

    private function createDefaultDbClass(): void
    {
        $this->db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
}