<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    public function add(array $user): void
    {
        $user['email'] = $user['email'];
        $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (login, pass)
           VALUES ('{$user['email']}', '{$user['pass']}');";
        $this->db->query($sql);
        //TODO validate!
    }
}