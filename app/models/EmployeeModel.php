<?php

namespace app\models;

use app\core\Model;

class EmployeeModel extends Model
{
    private string $table = 'employees';

    public function getAllEmployees()
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        $result = $stmt->get_result();

        $employees = [];

        while ($row = $result->fetch_assoc())
        {
            $employees[] = $row;
        }

        return $employees;
    }
}