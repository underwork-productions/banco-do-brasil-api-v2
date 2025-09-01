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

    /**
     * @param  int  $numeroConvenio  Número do convênio do cliente com o BB Pay. É obrigatório para todos os recursos
     * @param  string  $urlCallback  URL na qual o cliente será redirecionado após a conclusão do pagamento.
     * @param  null|bool  $pagamentoUnico  Indica se o pagamento pode ou não ser pago mais de uma vez. Se aceitar Open Finance ou Boleto, deve ser true.
     * @param  null|string  $timestampLimiteSolicitacao  Data e hora limite máximo para pagamento da solicitação de pagamento (timestamp). Se não informado, sistema assumirá como 365 dias.
     * @param  null|float  $valorSolicitacao  Valor que o cliente deseja receber do pagador, quando não informado será definido pelo pagador. Obrigatório para pagamentoUnico = true
     * @param  null|string  $descricaoSolicitacaoPagamento  Descrição da solicitação do pagamento. Dado que pode estar visível ao pagador.
     * @param  null|string  $codigoConciliacaoSolicitacao  Campo utilizado para armazenar um código único que referencie a sua venda em seu sistema, possibilitando uma correspondência direta entre a sua venda e a solicitação gerada. A conciliação de registros entre seu sistema e o BB Pay pode ser realizada com o uso deste campo ou com o número da solicitação.
     * @return void
     */
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
