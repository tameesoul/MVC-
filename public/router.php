<?php

use App\Config;
use App\Container;

$dotenv = Dotenv\Dotenv::createImmutable('../src/');
$dotenv->load();

use App\App;
use App\Controller\HomeController;
use App\Router;

$container = new Container();
$router = new Router($container);
$router->registerRoutes(HomeController::class);

(new App($router, 

new Config($_ENV)
))->run();
