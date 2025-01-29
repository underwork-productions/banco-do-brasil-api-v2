<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Defaults;
use UnderWork\BancoDoBrasilApiV2\Enums\Environment;

final class NullConfiguration implements BBConfiguration
{
    public function __construct(
        private string $developerApplicationKey = '',
        private string $clientId = '',
        private string $clientSecret = '',
        private Environment $environment = Defaults::DEFAULT_ENVIRONMENT,
        private int $maxRetries = Defaults::DEFAULT_MAX_RETRIES
    ) {
        if ($this->maxRetries < 0) {
            throw new \InvalidArgumentException('Max retries must be greater than or equal to 0.');
        }
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException('Unknown property: '.$name);
    }
}
