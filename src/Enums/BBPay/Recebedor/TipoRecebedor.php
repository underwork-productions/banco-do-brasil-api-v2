<?php

declare(strict_types=1);

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

enum TipoRecebedor: string
{
    use EnhancedEnum;

    case Participante = 'participante';

    case Convenio = 'convenio';
}
