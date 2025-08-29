<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Boleto;

trait HasSandboxUrl
{
    protected function getSandboxUrl(): string
    {
        return 'https://api.sandbox.bb.com.br/cobrancas/v2';
    }
}
