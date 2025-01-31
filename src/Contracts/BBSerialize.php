<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Contracts;

use JsonSerializable;

interface BBSerialize extends JsonSerializable
{
    public function toArray(): array;
}
