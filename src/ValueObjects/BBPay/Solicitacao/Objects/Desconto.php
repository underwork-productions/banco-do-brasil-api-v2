<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;

/**
 * @param  string  $dataLimite  Data limite de aplicação do desconto
 * @param  float|null  $valorFixo  Valor nominal do desconto.
 * @param  float|null  $valorPercentual  Valor percentual do desconto
 *
 * @mixin IdeHelperDescontoBuilder
 *
 * @since 0.0.3
 */
class Desconto implements BBSerialize
{
    use HasBuilder;

    public function __construct(
        public readonly string $dataLimite,
        public readonly ?float $valorFixo = 0,
        public readonly ?float $valorPercentual = 0
    ) {}

    public function toArray(): array
    {
        return [
            'dataLimite' => $this->dataLimite,
            'valorFixo' => $this->valorFixo,
            'valorPercentual' => $this->valorPercentual,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
