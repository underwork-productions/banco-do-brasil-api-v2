<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * Tipo de documento informado pelo usuário pagador
 *
 * @since 0.0.1
 */
enum TipoDocumento: string
{
    use EnhancedEnum;

    /**
     * Tipo do documento é CPF
     */
    case Cpf = 'cpf';

    /**
     * Tipo do documento é CNPJ
     */
    case Cnpj = 'cnpj';
}
