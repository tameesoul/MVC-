<?php


namespace App\Models;
use App\Model;

class User extends Model
{


    public function getAll()
    {
        $statement = $this->db->query('SELECT * FROM users');
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

}