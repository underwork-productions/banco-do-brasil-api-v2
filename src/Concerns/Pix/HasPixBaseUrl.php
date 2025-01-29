<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Pix;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Enums\Environment;

trait HasPixBaseUrl
{
    use HasPixProductionUrl, HasPixSandboxUrl;

    protected function getBaseUrl(?BBConfiguration $configuration = null): string
    {
        return match ($configuration?->environment) {
            Environment::PRODUCTION => $this->getProductionUrl(),
            default => $this->getSandboxUrl(),
        };
    }
}
