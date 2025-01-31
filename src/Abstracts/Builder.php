<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Abstracts;

/**
 * Class responsible for creating generic builders.
 */
abstract class Builder
{
    /**
     * This method will check if the property exists on the class then create a new instance and set its value
     *
     * @since 0.0.1
     *
     * @return Builder
     *
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        if (property_exists(static::class, $name)) {
            return (new static)->__setProperty($name, ...$arguments);
        }

        throw new \Exception("Property $name does not exist on ".self::class);
    }

    /**
     * This method will check if the property exists on the class then and set its value
     *
     * @since 0.0.1
     *
     * @return Builder
     *
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (property_exists(static::class, $name)) {
            return $this->__setProperty($name, ...$arguments);
        }

        throw new \Exception("Property $name does not exist on ".self::class);
    }

    /**
     * Dynamically sets the property on the class
     *
     * @since 0.0.1
     */
    protected function __setProperty(string $propertyName, mixed $value): self
    {
        $this->{$propertyName} = $value;

        return $this;
    }

    /**
     * This method is responsible for creating the object with all the previous declared properties
     *
     * @return mixed
     */
    abstract public function build();
}
