<?php

namespace app\database;

class CreateDB
{
    protected \mysqli $db;

    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USER, DB_PASS, '');
    }


    /**
     * prepare to creating new DB
     * @return void
     */
    public static function create(): void
    {
        $createDb = new CreateDB();
        $dbName = DB_NAME;
        $createDb->createDb($dbName);
        $createDb->createTables($dbName);
    }


    /**
     * @param $dbName
     * @return void
     */
    private function createDb($dbName): void
    {
        $sql = "CREATE DATABASE if not exists $dbName";
        $this->db->query($sql);
    }


    /**
     * @param $dbName
     * @return void
     */
    private function createTables($dbName): void
    {
        $users_sql = "CREATE TABLE if not exists $dbName.users(
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            login VARCHAR(60) NOT NULL,
            pass VARCHAR(255) NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
        )";
        $this->db->query($users_sql);
    }

}