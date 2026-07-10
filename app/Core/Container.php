<?php

namespace Sendity\Core;

use ReflectionClass;

class Container
{
    protected array $bindings = [];
    protected array $instances = [];
public function __construct()
{
    $this->instances[self::class] = $this;
}
    public function bind(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = [
            'factory' => $factory,
            'singleton' => false,
        ];
    }

    public function singleton(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = [
            'factory' => $factory,
            'singleton' => true,
        ];
    }

    public function get(string $abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (isset($this->bindings[$abstract])) {

            $binding = $this->bindings[$abstract];

            $instance = $binding['factory']($this);

            if ($binding['singleton']) {
                $this->instances[$abstract] = $instance;
            }

            return $instance;
        }

        return $this->build($abstract);
    }

    protected function build(string $class)
    {
        if (!class_exists($class)) {
            throw new \Exception("Class {$class} not found");
        }

        $reflection = new ReflectionClass($class);

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $class;
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $param) {

            $type = $param->getType();

            if (!$type) {
                throw new \Exception(
                    "Cannot resolve {$param->getName()} in {$class}"
                );
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}