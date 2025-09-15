<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\BBPay;

trait HasProductionUrl
{
    protected function getProductionUrl(): string
    {
        return 'https://checkout.mtls.api.bb.com.br/v2';
    }
}
