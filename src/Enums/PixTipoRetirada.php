<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * @since 0.0.1
 */
enum PixTipoRetirada: string
{
    use EnhancedEnum;

    case Saque = 'saque';

    case Troco = 'troco';
}
