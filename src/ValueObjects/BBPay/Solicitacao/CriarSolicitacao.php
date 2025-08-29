<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao;

use League\Pipeline\Pipeline;
use UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects\Devedor;
use UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects\FormaPagamento;
use UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects\Geral;
use UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects\Repasse;
use UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects\Vencimento;
use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;

/**
 * @since 0.0.3
 */
final class CriarSolicitacao implements BBSerialize
{
    /**
     * @param  Devedor  $devedor  É obrigatório informar devedor para solicitações de pagamentos que aceitem boleto e Pix via Open Finance.
     * @param  array<FormaPagamento>  $formasPagamento  Consulte o seu gerente sobre quais formas de pagamento poderão ser habilitadas no seu convênio. Elas também podem ser consultadas no BB Digital PJ > Cobrança e recebimentos > BB Pay. Para disponibilizar a opção de financiamento para os clientes, é necessário ter atividade econômica aderente aos itens comercializáveis (avaliado pelo BB no momento da contratação).
     * @param  Repasse  $repasse  É utilizado para informações de split de pagamentos. Se não preenchido, o pagamento será repassado para o convênio, conforme dados bancários informados no momento da contratação do BB Pay. Não há limite para a quantidade de recebedores, desde que respeitados os valores ou percentuais informados.
     * @return void
     */
    public function __construct(
        public readonly Geral $geral,
        public readonly Vencimento $vencimento,
        public readonly ?Devedor $devedor = null,
        public readonly ?array $formasPagamento = [],
        public readonly ?Repasse $repasse = null,
    ) {
        // TODO: add pipelines for checking

        (new Pipeline)
            ->process($this);
    }

    public function toArray(): array
    {
        $array = [
            'geral' => $this->geral->toArray(),
        ];

        if (! is_null($this->devedor)) {
            $array['devedor'] = $this->devedor->toArray();
        }

        return $array;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
