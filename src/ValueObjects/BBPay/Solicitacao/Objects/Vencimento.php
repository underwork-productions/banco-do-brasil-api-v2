<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao\Objects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;

/**
 * @param  string  $data
 * @param  float|null  $multaPercentual  Valor percentual de multa cobrada após o vencimento.
 * @param  float|null  $multaValorFixo  Valor nominal de multa cobrada após o vencimento
 * @param  float|null  $jurosPercentual  Valor percentual de juros ao mês, calculado pro rata por dia de atraso do pagamento
 * @param  array<Desconto>|null  $descontos  É possível definir até 3 datas de desconto com valores específicos para cada um. Basta indicar as datas dos descontos em ordem cronológica e os descontos do maior para o menor.
 *
 * @mixin IdeHelperVencimentoBuilder
 *
 * @since 0.0.3
 */
class Vencimento implements BBSerialize
{
    use HasBuilder;

    public function __construct(
        public readonly string $data,
        public readonly ?float $multaPercentual = 0,
        public readonly ?float $multaValorFixo = 0,
        public readonly ?float $jurosPercentual = 0,
        public readonly ?array $descontos = [],
    ) {}

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'multaPercentual' => $this->multaPercentual,
            'multaValorFixo' => $this->multaValorFixo,
            'jurosPercentual' => $this->jurosPercentual,
            'descontos' => $this->descontos,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
