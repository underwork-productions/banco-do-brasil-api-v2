<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\Pix;

use League\Pipeline\Pipeline;
use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Enums\ModalidadeAgente;
use UnderWork\BancoDoBrasilApiV2\Enums\ModalidadeAlteracao;
use UnderWork\BancoDoBrasilApiV2\Enums\PixTipoRetirada;
use UnderWork\BancoDoBrasilApiV2\Enums\TipoDocumento;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsRequiredDocumentoDevedor;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidDocumentoDevedor;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidExpiracao;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidInfoAdicionais;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidNomeDevedor;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidRetirada;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidSolicitacaoPagador;
use UnderWork\BancoDoBrasilApiV2\Pipelines\IsValidValor;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects\NullEnum;

/**
 * @since 0.0.1
 */
final class CobrancaImediata implements BBSerialize
{
    public readonly ?string $devedorDocumento;

    public readonly string|TipoDocumento|NullEnum|null $devedorTipoDocumento;

    public readonly string|ModalidadeAlteracao|NullEnum|null $modalidadeAlteracao;

    public readonly string|PixTipoRetirada|NullEnum|null $tipoRetirada;

    public readonly string|ModalidadeAlteracao|NullEnum|null $retiradaModalidadeAlteracao;

    public readonly string|ModalidadeAgente|NullEnum|null $retiradaModalidadeAgente;

    /**
     * @param  int  $expiracao  Tempo de vida da cobrança, em segundos, a partir da data de criação. Deve maior do que zero. Se não enviado (em branco), assume 86.400 segundos, ou 24 horas (default). Máximo: 2.147.483.648 segundos.
     * @param  string  $valor  Valor original da cobrança. Deve ser informado, com casas decimais, mesmo que seja 0.
     * @param  string  $chave  Chave Pix do usuário recebedor.
     * @param  string|null  $devedorNome  Nome do devedor, máximo 200 caracteres. Se preenchido, o CPF ou o CNPJ deve ser informado.
     * @param  string|null  $devedorDocumento  Deve ser preenchido com o CNPJ ou CPF do devedor. Se preenchido, o nome deve ser informado.
     * @param  int|null  $locId  Id do location. Deve ser informado se o usuário recebedor desejar utilizar um location previamente reservado, do tipo `cob`.
     * @param  string|TipoDocumento|NullEnum|null  $devedorTipoDocumento  Quando documento é fornecido esse campo deve ser informado para identificar o tipo de documento.
     * @param  string|ModalidadeAlteracao|NullEnum|null  $modalidadeAlteracao  Determina se o valor final da cobrança pode ser alterado pelo usuário pagador. Se omitido, assume valor 0.
     * @param  string|null  $solicitacaoPagador  Opcional, representa um texto, a ser apresentado ao usuário pagador para que ele possa digital uma informação correlata, em formato livre, a ser enviada ao usuário recebedor. Máximo 140 caracteres.
     * @param  array<int,array<string,string>>|null  $infoAdicionais  Cada informação adicional será apresentada ao usuário pagador. Máximo 50 itens.
     * @param  string|PixTipoRetirada|NullEnum|null  $tipoRetirada  Estrutura opcional; se utilizada, a cobrança deixa de considerada Pix comum e passa à categoria de Pix Saque e Pix Troco.
     * @param  string|null  $retiradaValor  Valor do saque/troco a ser realizado. Deve ser informado, com casas decimais, mesmo que seja 0.
     * @param  string|ModalidadeAlteracao|NullEnum|null  $retiradaModalidadeAlteracao  Determina se o valor final da cobrança pode ser alterado pelo usuário pagador. Se omitido, assume valor 0.
     * @param  string|ModalidadeAgente|NullEnum|null  $retiradaModalidadeAgente  Indica a modalidade do agente por meio da qual se dá a facilitação do serviço de saque
     * @param  string|null  $retiradaPrestadorDoServicoDeSaque  ISPB do Facilitador de Serviço de Saque
     * @return void
     */
    public function __construct(
        public readonly int $expiracao,
        public readonly string $valor,
        public readonly string $chave,
        public readonly ?string $devedorNome = null,
        public readonly ?int $locId = null,
        public readonly ?string $solicitacaoPagador = null,
        public readonly ?array $infoAdicionais = null,
        ?string $devedorDocumento = null,
        $devedorTipoDocumento = null,
        $modalidadeAlteracao = null,
        $tipoRetirada = null,
        public readonly ?string $retiradaValor = null,
        $retiradaModalidadeAlteracao = null,
        $retiradaModalidadeAgente = null,
        public readonly ?string $retiradaPrestadorDoServicoDeSaque = null,
    ) {
        $this->devedorDocumento = ! is_null($devedorDocumento) ? preg_replace('/\D/', '', $devedorDocumento) : null;

        $this->devedorTipoDocumento = TipoDocumento::tryFromEnhanced($devedorTipoDocumento);

        $this->modalidadeAlteracao = ModalidadeAlteracao::tryFromEnhanced($modalidadeAlteracao);

        $this->retiradaModalidadeAlteracao = ModalidadeAlteracao::tryFromEnhanced($retiradaModalidadeAlteracao);

        $this->tipoRetirada = PixTipoRetirada::tryFromEnhanced($tipoRetirada);

        $this->retiradaModalidadeAgente = ModalidadeAgente::tryFromEnhanced($retiradaModalidadeAgente);

        (new Pipeline)
            ->pipe(new IsValidExpiracao)
            ->pipe(new IsValidNomeDevedor)
            ->pipe(new IsValidDocumentoDevedor)
            ->pipe(new IsRequiredDocumentoDevedor)
            ->pipe(new IsValidValor)
            ->pipe(new IsValidRetirada)
            ->pipe(new IsValidSolicitacaoPagador)
            ->pipe(new IsValidInfoAdicionais)
            ->process($this);
    }

    public function toArray(): array
    {
        $array = [
            'calendario' => ['expiracao' => $this->expiracao],
            'chave' => $this->chave,
            'valor' => [
                'original' => $this->valor,
            ],
        ];

        if (! is_null($this->modalidadeAlteracao->value)) {
            $array['valor']['modalidadeAlteracao'] = $this->modalidadeAlteracao->value;
        }

        if ($this->devedorDocumento) {
            $array['devedor'] = [
                'nome' => $this->devedorNome,
                $this->devedorTipoDocumento->value => $this->devedorDocumento,
            ];
        }

        if ($this->locId) {
            $array['loc'] = ['id' => $this->locId];
        }

        if ($this->tipoRetirada->value) {
            $array['valor']['retirada'][$this->tipoRetirada->value] = [
                'valor' => $this->retiradaValor,
                'modalidadeAlteracao' => $this->retiradaModalidadeAlteracao->value,
                'modalidadeAgente' => $this->retiradaModalidadeAgente->value,
                'prestadorDoServicoDeSaque' => $this->retiradaPrestadorDoServicoDeSaque,
            ];
        }

        if ($this->solicitacaoPagador) {
            $array['solicitacaoPagador'] = $this->solicitacaoPagador;
        }

        if ($this->infoAdicionais) {
            $array['infoAdicionais'] = $this->infoAdicionais;
        }

        return $array;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
