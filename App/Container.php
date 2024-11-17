<?php

namespace App;

use App\Exception\Container\NotFoundClass;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id): object
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            return $entry($this);
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $value): void
    {
        $this->entries[$id] = $value;
    }

    private function resolve(string $id): object
    {
        try {
            $reflectionClass = new ReflectionClass($id);
        } catch (ReflectionException $e) {
            throw new NotFoundClass("Class $id not found: " . $e->getMessage());
        }

        if (!$reflectionClass->isInstantiable()) {
            throw new NotFoundClass("Class $id is not instantiable.");
        }

        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id;
        }

        $dependencies = array_map(fn(ReflectionParameter $param) => $this->resolveParameter($param, $id), $parameters);
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    private function resolveParameter(ReflectionParameter $param, string $id): object
    {
        $type = $param->getType();
        if (!$type || $type instanceof \ReflectionUnionType) {
            throw new \Exception("Cannot resolve parameter {$param->getName()} in $id");
        }
        return $this->get($type->getName());
    }
}
