<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;

/**
 * @mixin IdeHelperGeralBuilder
 *
 * @since 0.0.3
 */
class Geral implements BBSerialize
{
    use HasBuilder;

    public function __construct(
        public readonly int $numeroConvenio,
        public readonly string $urlCallback,
        public readonly ?bool $pagamentoUnico = false,
        public readonly ?string $timestampLimiteSolicitacao = null,
        public readonly ?float $valorSolicitacao = null,
        public readonly ?string $descricaoSolicitacaoPagamento = null,
        public readonly ?string $codigoConciliacaoSolicitacao = null,
    ) {}

    public function toArray(): array
    {
        return [
            'numeroConvenio' => $this->numeroConvenio,
            'urlCallback' => $this->urlCallback,
            'pagamentoUnico' => $this->pagamentoUnico,
            'timestampLimiteSolicitacao' => $this->timestampLimiteSolicitacao,
            'valorSolicitacao' => $this->valorSolicitacao,
            'descricaoSolicitacaoPagamento' => $this->descricaoSolicitacaoPagamento,
            'codigoConciliacaoSolicitacao' => $this->codigoConciliacaoSolicitacao,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
