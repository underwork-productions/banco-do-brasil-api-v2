<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * Indica a modalidade do agente por meio da qual se dá a facilitação do serviço de saque
 *
 * @since 0.0.1
 */
enum ModalidadeAgente: string
{
    use EnhancedEnum;

    /** Agente Estabelecimento Comercial */
    case AGTEC = 'AGTEC';

    /** Agente Outra Espécie de Pessoa Jurídica ou Correspondente no País */
    case AGTOT = 'AGTOT';

    /** Agente Facilitador de Serviço de Saque */
    case AGPSS = 'AGPSS';
}
