<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * Determina se o valor final da cobrança pode ser alterado pelo usuário pagador
 *
 * @since 0.0.1
 */
enum ModalidadeAlteracao: int
{
    use EnhancedEnum;

    /**
     * Usuário pagador `NÃO` pode alterar valor.
     */
    case NaoPode = 0;

    /**
     * Usuário pagador pode alterar valor.
     */
    case Pode = 1;
}
