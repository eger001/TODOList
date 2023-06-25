<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    private string $table = 'users';


    /**
     * add new user data to DB
     * @param array $user
     * @return void
     */
    public function add(array $user): void
    {
        $user['email'] = $user['email'];
        $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (login, pass)
           VALUES ('{$user['email']}', '{$user['pass']}');";
        $this->db->query($sql);
        //TODO validate!
    }


    /**
     * get all user data
     * @param string $email
     * @return array|null
     */
    public function get(string $email): array|null
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE users.login = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAllUsers(): array|null
    {
        $stmt = $this->db->prepare("SELECT login FROM $this->table ");
        $stmt->execute();
        $result = $stmt->get_result();

        $usersEmails = [];

        while($row = $result->fetch_assoc())
        {
            $usersEmails[] = $row['login'];
        }

        return $usersEmails;
    }
}