<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Boleto;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Enums\Environment;

trait HasBoletoBaseUrl
{
    use HasBoletoProductionUrl, HasBoletoSandboxUrl, HasBoletoUnsecureSandboxUrl;

    protected function getBaseUrl(?BBConfiguration $configuration = null): string
    {
        return match ($configuration?->environment) {
            Environment::PRODUCTION => $this->getProductionUrl(),
            Environment::SANDBOX => $this->getSandboxUrl(),
            default => $this->getUnsecureSandboxUrl()
        };
    }
}
