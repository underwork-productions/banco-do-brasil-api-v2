<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects;

final class NullEnum extends \stdClass
{
    public readonly string $name;

    public readonly null $value;

    public function __construct()
    {
        $this->name = 'NULO';
        $this->value = null;
    }
}
