<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }


    /**
     * @param string $prop
     * @param array $data
     * @return void
     */
    public static function  save(string $prop, mixed $data): void
    {
        $_SESSION[$prop] = $data;
    }


    /**
     * @param $prop
     * @return array
     */
    public static function all($prop): array
    {
        if (isset($_SESSION[$prop]))
        {
            $errors = $_SESSION[$prop];
            self::unset($prop);
            return $errors;
        }
        return [];
    }


    /**
     * @param $prop
     * @return void
     */
    private static function unset($prop): void
    {
        unset($_SESSION[$prop]);
    }

    public static function setLocale($locale = 'ua'): string
    {
        return $_SESSION['locale'] = $locale;
    }

}