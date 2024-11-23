<?php


namespace App;



class Config
{

    private $config = [];
    public function __construct(Array $env)
    {
        $this->config = 
        [
            'db'=>
            [
                    'host' => $env['DB_HOST'],
                    'user' => $env['DB_USERNAME'],
                    'password' => $env['DB_PASSWORD'],
                    'dbname' => $env['DB_NAME'],
                    'driver' => 'pdo_mysql',
            ]
        ];
    }


    public function __get($name)
    {
        return $this->config[$name]??null;
    }
}