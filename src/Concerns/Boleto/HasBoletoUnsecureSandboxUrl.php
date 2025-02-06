<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Boleto;

trait HasBoletoUnsecureSandboxUrl
{
    /**
     * This returns the api url that doesn't requires mTLS
     */
    protected function getUnsecureSandboxUrl(): string
    {
        return 'https://api.hm.bb.com.br/cobrancas/v2';
    }
}
