<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Traits;

use ReflectionClass;
use ReflectionProperty;

/**
 * This trait will check if every public property is null
 */
trait IsNullValueObject
{
    public function isNull(): bool
    {
        $reflection = new ReflectionClass($this);

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $value = $property->getValue($this);

            if (! is_null($value)) {
                /** If is not a builtin type, means that is a class */
                if (! $property->getType()->isBuiltin()) {
                    $innerReflection = new ReflectionClass($value);
                    /** Check if class has the method isNull and then check its result */
                    if ($innerReflection->hasMethod('isNull') && $value->isNull()) {
                        /** The class is null. Continue to the next one */
                        continue;
                    }
                }

                return false;
            }
        }

        return true;
    }
}
