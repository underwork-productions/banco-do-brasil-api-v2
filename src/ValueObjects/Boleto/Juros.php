<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\Boleto;

use UnderWork\BancoDoBrasilApiV2\Traits\IsNullValueObject;

final class Juros
{
    use IsNullValueObject;

    public function __construct(
        public readonly ?int $tipo = null,
        public readonly ?float $porcentagem = null,
        public readonly ?float $valor = null
    ) {}
}
