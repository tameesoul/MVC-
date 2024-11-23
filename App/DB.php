<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DB 
{
    private ?Connection $conn = null;


    public function __construct(Array $config )
    {
        if ($this->conn===null) {             
              $this->conn = DriverManager::getConnection($config);
               
        }
    }


    public function __call($method, $args)
    {
        return call_user_func_array(array($this->conn, $method ), $args);
    }
    
}
