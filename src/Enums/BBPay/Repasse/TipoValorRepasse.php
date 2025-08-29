<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums\BBPay\Repasse;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * @since 0.0.3
 */
enum TipoValorRepasse: string
{
    use EnhancedEnum;

    /**
     * Se informado “fixo”, a soma dos valores do split deve ser igual ao valor da solicitação.
     */
    case Fixo = 'FIXO';

    /**
     * Se informado “percentual”, a soma dos valores do split deve ser igual a 100%.
     */
    case Percentual = 'PERCENTUAL';
}
