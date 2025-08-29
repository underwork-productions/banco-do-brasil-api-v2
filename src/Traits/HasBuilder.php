<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Traits;

trait HasBuilder
{
    public function __call($name, $arguments)
    {
        if (property_exists($this, $name)) {
            $this->$name = $arguments[0] ?? null;

            return $this;
        }
        throw new \BadMethodCallException("Property $name does not exist on ".static::class);
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = static::createPartialBuilder();
        if (property_exists($instance, $name)) {
            $instance->$name = $arguments[0] ?? null;

            return $instance;
        }
        throw new \BadMethodCallException("Property $name does not exist on ".static::class);
    }

    /**
     * Creates a partial builder object without invoking the constructor.
     * This allows chaining property setters before required constructor args are set.
     */
    private static function createPartialBuilder(): static
    {
        $reflection = new \ReflectionClass(static::class);

        return $reflection->newInstanceWithoutConstructor();
    }
}
