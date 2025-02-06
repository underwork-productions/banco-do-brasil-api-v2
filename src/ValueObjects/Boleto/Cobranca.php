<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\Boleto;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Traits\IsNullValueObject;

final class Cobranca implements BBSerialize
{
    use IsNullValueObject;

    public function __construct(
        public readonly ?int $numeroConvenio = null,
        public readonly ?string $dataVencimento = null,
        public readonly ?float $valorOriginal = null,
        public readonly ?int $numeroCarteira = null,
        public readonly ?int $numeroVariacaoCarteira = null,
        public readonly ?int $codigoModalidade = null,
        public readonly ?string $dataEmissao = null,
        public readonly ?float $valorAbatimento = null,
        public readonly ?float $quantidadeDiasProtesto = null,
        public readonly ?int $quantidadeDiasNegativacao = null,
        public readonly ?int $orgaoNegativador = null,
        public readonly ?string $indicadorAceiteTituloVencido = null,
        public readonly ?int $numeroDiasLimiteRecebimento = null,
        public readonly ?string $codigoAceite = null,
        public readonly ?int $codigoTipoTitulo = null,
        public readonly ?string $descricaoTipoTitulo = null,
        public readonly ?string $indicadorPermissaoRecebimentoParcial = null,
        public readonly ?string $numeroTituloBeneficiario = null,
        public readonly ?string $campoUtilizacaoBeneficiario = null,
        public readonly ?string $numeroTituloCliente = null,
        public readonly ?string $mensagemBloquetoOcorrencia = null,
        public readonly ?string $indicadorPix = null,
        public readonly ?Desconto $desconto = new Desconto,
        public readonly ?Desconto $segundoDesconto = new Desconto,
        public readonly ?Desconto $terceiroDesconto = new Desconto,
        public readonly ?Juros $jurosMora = new Juros,
        public readonly ?Multa $multa = new Multa,
        public readonly ?Pagador $pagador = new Pagador,
        public readonly ?Beneficiario $beneficiarioFinal = new Beneficiario,
    ) {}

    public function toArray(): array
    {
        return (array) $this;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
