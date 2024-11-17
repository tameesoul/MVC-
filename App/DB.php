<?php

namespace App;

use PDO;
use PDOException;

class DB 
{
    private ?PDO $pdo = null;


    public function __construct(Array $config )
    {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO(
                    "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=utf8",
                    $config['user'],
                    $config['password']
                );                

                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
    }

    

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->pdo, $method ), $args);
    }
    
}
