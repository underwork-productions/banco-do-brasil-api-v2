<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\BBPay;

trait HasSandboxUrl
{
    protected function getSandboxUrl(): string
    {
        return 'https://checkout.mtls.api.hm.bb.com.br/v2';
    }
}
