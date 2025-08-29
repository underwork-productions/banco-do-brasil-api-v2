<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\BBPay;

trait HasUnsecureSandboxUrl
{
    protected function getUnsecureSandboxUrl(): string
    {
        return 'https://checkout.mtls.api.hm.bb.com.br/v2';
    }
}
