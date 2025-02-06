<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\Boleto;

use UnderWork\BancoDoBrasilApiV2\Traits\IsNullValueObject;

final class Beneficiario
{
    use IsNullValueObject;

    public function __construct(
        public readonly ?int $tipoInscricao = null,
        public readonly ?int $numeroInscricao = null,
        public readonly ?string $nome = null,
    ) {}
}
