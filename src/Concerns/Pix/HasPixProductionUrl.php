<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Concerns\Pix;

trait HasPixProductionUrl
{
    protected function getProductionUrl(): string
    {
        return 'https://api-pix.bb.com.br/pix/v2';
    }
}
