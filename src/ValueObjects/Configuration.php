<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Defaults;
use UnderWork\BancoDoBrasilApiV2\Enums\Environment;

/**
 * @since 0.0.1
 *
 * @property string $developerApplicationKey
 * @property string $clientId
 * @property string $clientSecret
 * @property Environment $environment
 * @property int $maxRetries
 */
final class Configuration implements BBConfiguration
{
    public function __construct(
        public readonly string $developerApplicationKey,
        public readonly string $clientId,
        public readonly string $clientSecret,
        public readonly Environment $environment = Defaults::DEFAULT_ENVIRONMENT,
        public readonly int $maxRetries = Defaults::DEFAULT_MAX_RETRIES
    ) {
        if ($this->maxRetries < 0) {
            throw new \InvalidArgumentException('Max retries must be greater than or equal to 0.');
        }
    }
}
