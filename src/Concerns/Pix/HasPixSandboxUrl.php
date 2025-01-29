<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Pix;

trait HasPixSandboxUrl
{
    protected function getSandboxUrl(): string
    {
        return 'https://api-pix.hm.bb.com.br/pix/v2';
    }
}
