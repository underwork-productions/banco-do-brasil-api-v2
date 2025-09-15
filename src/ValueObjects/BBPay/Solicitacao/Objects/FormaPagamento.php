<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao\Objects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Enums\BBPay\TipoFormaPagamento;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;

/**
 * @param  TipoFormaPagamento|string  $codigoTipoPagamento
 * @param  int  $quantidadeParcelas  1 para Pix, BLT, OPB, CDC e LIV. Para cartão de crédito (EC3), conforme condições habilitadas no convênio.
 *
 * @mixin IdeHelperFormaPagamentoBuilder
 *
 * @since 0.0.3
 */
class FormaPagamento implements BBSerialize
{
    use HasBuilder;

    public readonly TipoFormaPagamento $codigoTipoPagamento;

    /**
     * @param  TipoFormaPagamento|string  $codigoTipoPagamento
     * @return void
     */
    public function __construct(
        $codigoTipoPagamento,
        public readonly int $quantidadeParcelas
    ) {
        $this->codigoTipoPagamento($codigoTipoPagamento);
    }

    public function codigoTipoPagamento(TipoFormaPagamento|string $value): self
    {
        $this->codigoTipoPagamento = TipoFormaPagamento::tryFromEnhanced($value);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'codigoTipoPagamento' => $this->codigoTipoPagamento->value,
            'quantidadeParcelas' => $this->quantidadeParcelas,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
