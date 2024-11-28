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
                    'username' => $env['DB_USERNAME'],
                    'password' => $env['DB_PASSWORD'],
                    'database' => $env['DB_NAME'],
                    'driver' => 'mysql',
                    'charset' => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix' => '',
            ]
        ];
    }


    public function __get($name)
    {
        return $this->config[$name]??null;
    }
}