<?php


namespace App\Models;

use App\Model;

class User extends Model
{
    public function getAll()
    {
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')
           ->from('users');
        return $qb->executeQuery()->fetchAllAssociative();
    }
}
