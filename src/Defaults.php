<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2;

use UnderWork\BancoDoBrasilApiV2\Enums\Environment;

abstract class Defaults
{
    const DEFAULT_ENVIRONMENT = Environment::SANDBOX;

    const DEFAULT_MAX_RETRIES = 3;
}
