<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Contracts;

use JsonSerializable;

interface BBSerialize extends JsonSerializable
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
