<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums;

enum Environment: string
{
    case SANDBOX = 'sandbox';
    case PRODUCTION = 'production';
    case NO_mTLS = 'no-mtls';
}
