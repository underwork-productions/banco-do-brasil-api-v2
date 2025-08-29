<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums\BBPay\Devedor;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * Tipo do documento do devedor
 *
 * @since 0.0.3
 */
enum TipoDocumento: int
{
    use EnhancedEnum;

    /**
     * Tipo do documento é CPF
     */
    case Cpf = 1;

    /**
     * Tipo do documento é CNPJ
     */
    case Cnpj = 2;
}
