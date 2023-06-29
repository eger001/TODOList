<?php

namespace app\core;

use app\database\CreateDB;
use mysqli_sql_exception;

class Model
{
    protected \mysqli $db;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
//        CreateDB::create();
        try {
            $this->createDefaultDbClass();
            if ($this->db->connect_errno === 1049 || $this->db->connect_errno === 2002) {
                throw new \Exception('Some problem with database connection');
            }
        } catch (\Exception $exception) {
            if ($this->db->connect_errno) {
                echo $exception->getMessage();
                exit();
            }
        }
    }


    /**
     * create new DB with params
     * @return void
     */
    private function createDefaultDbClass(): void
    {
        $this->db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
}