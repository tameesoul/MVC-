<?php


namespace App;


class App
{
    protected static  DB $PDO;

    public function __construct(protected Router $router , Config $config)
    {
        static::$PDO = new DB($config->db);
    }

    public static function DB()
    {
        return static::$PDO;
    }

    public function run()
    {
       echo $this->router->resolve();
    }
}