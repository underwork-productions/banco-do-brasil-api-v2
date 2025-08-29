<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects;

/**
 * @since 0.0.3
 */
final class NullSerializable implements \JsonSerializable
{
    public function toArray(): array
    {
        return [];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
