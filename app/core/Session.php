<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public static function  save(string $prop, array $data): void
    {
        $_SESSION[$prop] = $data;
    }

    public static function all($prop)
    {
        if (isset($_SESSION[$prop]))
        {
            $errors = $_SESSION[$prop];
            self::unset($prop);
            return $errors;
        }
        return [];
    }



    private static function unset($prop): void
    {
        unset($_SESSION[$prop]);
    }
}