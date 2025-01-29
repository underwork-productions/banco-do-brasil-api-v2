<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Abstracts;

abstract class Builder
{
    public static function __callStatic($name, $arguments)
    {
        if (property_exists(static::class, $name)) {
            return (new static)->__setProperty($name, ...$arguments);
        }

        throw new \Exception("Property $name does not exist on ".self::class);
    }

    public function __call($name, $arguments)
    {
        if (property_exists(static::class, $name)) {
            return $this->__setProperty($name, ...$arguments);
        }

        throw new \Exception("Property $name does not exist on ".self::class);
    }

    protected function __setProperty(string $propertyName, mixed $value): self
    {
        $this->{$propertyName} = $value;

        return $this;
    }

    abstract public function build();
}
