<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Traits;

use UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects\NullEnum;

trait EnhancedEnum
{
    public static function tryFromEnhanced(int|string|self|NullEnum|null $value): static|NullEnum
    {
        if (is_null($value)) {
            return new NullEnum;
        }

        if ($value instanceof NullEnum || $value instanceof self) {
            return $value;
        }

        return static::tryFrom($value) ?? new NullEnum;
    }
}
