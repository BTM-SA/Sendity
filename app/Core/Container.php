<?php

namespace Sendity\Core;

use ReflectionClass;

class Container
{
    protected array $bindings = [];
    protected array $instances = [];

    public function bind(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = $factory;
    }

    public function singleton(string $abstract, callable $factory): void
    {
        $this->instances[$abstract] = $factory($this);
    }

    public function get(string $abstract)
    {
        // 1. Return singleton if already created
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        // 2. Use manual binding if exists
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]($this);
        }

        // 3. Auto-resolve via reflection
        return $this->build($abstract);
    }

    protected function build(string $class)
    {
        if (!class_exists($class)) {
            throw new \Exception("Class {$class} not found");
        }

        $reflection = new ReflectionClass($class);

        // If no constructor → just instantiate
        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $class;
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $param) {
            $type = $param->getType();

            if (!$type) {
                throw new \Exception("Cannot resolve {$param->getName()} in {$class}");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}