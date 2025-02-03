<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums;

enum Environment: string
{
    case Sandbox = 'sandbox';
    case Production = 'production';
    case No_mTLS = 'no-mtls';
}
