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
     * @param  array<mixed>  $arguments
     * @return Builder
     *
     * @throws \Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $reflection = new \ReflectionClass(static::class);
        $constructor = $reflection->getConstructor();

        if ($constructor && $constructor->getNumberOfRequiredParameters() > 0) {
            throw new \Exception('Unsafe usage of new static(): '.static::class.' requires constructor arguments.');
        }

        if (property_exists(static::class, $name)) {
            // @phpstan-ignore-next-line
            return (new static)->__setProperty($name, ...$arguments);
        }

        throw new \Exception("Property $name does not exist on ".self::class);
    }

    /**
     * This method will check if the property exists on the class then and set its value
     *
     * @since 0.0.1
     *
     * @param  array<mixed>  $arguments
     * @return Builder
     *
     * @throws \Exception
     */
    public function __call(string $name, array $arguments)
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
