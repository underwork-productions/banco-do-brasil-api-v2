<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines\BBPay;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;
use UnderWork\BancoDoBrasilApiV2\Enums\BBPay\TipoFormaPagamento;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao\CriarSolicitacao;

/**
 * @since 0.0.3
 */
class IsPagamentoUnico implements StageInterface
{
    private function paymentTypeRequiresSingleCharge($payload): bool
    {
        return v::keyNested('formasPagamento')
            ->each(v::oneOf(
                v::equals(TipoFormaPagamento::Boleto->value),
                v::equals(TipoFormaPagamento::OpenFinance->value)
            ))
            ->validate($payload);
    }

    /**
     * @param  CriarSolicitacao  $payload
     * @return mixed
     */
    public function __invoke($payload)
    {
        // TODO: Finish all validations for single payment.

        if (v::keyNested('geral.pagamentoUnico')->trueVal()->validate($payload)) {
            // Verifica por valores obriga'torios quando pagamento unico está ativo.
            if (v::keyNested('geral.valorSolicitacao')->nullType()->validate($payload)) {
                throw new \InvalidArgumentException('Valor da solicitação é obrigatório quando for pagamento único.');
            }

        } else {
            // Verifica se pagamento único deveria ser true
            if ($this->paymentTypeRequiresSingleCharge($payload)) {
                throw new \InvalidArgumentException('Pagamento único deve ser true quando a forma de pagamento for apenas boleto ou open finance.');
            }
        }

    }
}
