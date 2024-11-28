<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Illuminate\Database\Capsule\Manager as Capsule;
class DB 
{
    private static ?Capsule $conn = null;


    public function __construct(Array $config )
    {
        if (self::$conn===null) {             
              self::$conn = new Capsule;
              self::$conn->addConnection($config);  
              self::$conn->setAsGlobal();
              self::$conn->bootEloquent();
        }
    }


    public function __call($method, $args)
    {
        return call_user_func_array(array($this->conn, $method ), $args);
    }
    
}
