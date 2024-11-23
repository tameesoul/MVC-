<?php

namespace App;

use App\Attributes\Route;
use App\Exception\RouterNotFound;
use Exception;

class Router
{
    private $routes = [];


    public function __construct(private Container $container)
    {
    }

    public function registerRoutes(string $controllerClass)
    {
        $reflection = new \ReflectionClass($controllerClass);
    
        foreach ($reflection->getMethods() as $method) {
            $attributes = $method->getAttributes(Route::class);
    
            foreach ($attributes as $attribute) {
                $route = $attribute->newInstance();
                $this->routes[$route->method][$route->path] = [$controllerClass, $method->getName()];
            }
        }
    }
    

    public function resolve()
    {
        $basePath = '/project/public';
         $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }
        $method =$_SERVER['REQUEST_METHOD'];
        if (!isset($this->routes[$method][$uri])) {
            throw new RouterNotFound();
        } else {
            $callback = $this->routes[$method][$uri];
            if (is_callable($callback)) {
                return call_user_func($callback);
            } elseif (is_array($callback)) {
                [$controller, $method] = $callback;

                $controller = $this->container->get($controller);
                return call_user_func([$controller, $method]);
            }
        }

    }

}




