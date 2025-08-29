<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Boleto;

trait HasProductionUrl
{
    protected function getProductionUrl(): string
    {
        return 'https://api.bb.com.br/cobrancas/v2';
    }
}
