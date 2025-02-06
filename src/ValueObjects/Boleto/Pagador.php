<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\Boleto;

use UnderWork\BancoDoBrasilApiV2\Traits\IsNullValueObject;

final class Pagador
{
    use IsNullValueObject;

    public function __construct(
        public readonly ?int $tipoInscricao = null,
        public readonly ?int $numeroInscricao = null,
        public readonly ?string $nome = null,
        public readonly ?string $endereco = null,
        public readonly ?int $cep = null,
        public readonly ?string $cidade = null,
        public readonly ?string $bairro = null,
        public readonly ?string $uf = null,
        public readonly ?string $telefone = null,
        public readonly ?string $email = null,
    ) {}
}
