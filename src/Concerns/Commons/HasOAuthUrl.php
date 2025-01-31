<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Commons;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Enums\Environment;

trait HasOAuthUrl
{
    protected function getOAuthUrl(?BBConfiguration $configuration = null): string
    {
        return match ($configuration?->environment) {
            Environment::PRODUCTION => 'https://oauth.bb.com.br/oauth/token',
            default => 'https://oauth.hm.bb.com.br/oauth/token',
        };
    }
}
