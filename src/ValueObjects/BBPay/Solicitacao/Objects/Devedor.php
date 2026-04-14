<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao\Objects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Enums\BBPay\Devedor\TipoDocumento;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects\NullEnum;

/**
 * @param  TipoDocumento|NullEnum|null  $tipoDocumento
 *
 * @mixin IdeHelperDevedorBuilder
 *
 * @since 0.0.3
 */
class Devedor implements BBSerialize
{
    use HasBuilder;

    public readonly TipoDocumento $tipoDocumento;

    /**
     * @param  TipoDocumento|int  $tipoDocumento
     * @return void
     */
    public function __construct(
        $tipoDocumento,
        public readonly string $numeroDocumento,
        public readonly ?string $cep = null,
        public readonly ?string $endereco = null,
        public readonly ?string $bairro = null,
        public readonly ?string $cidade = null,
        public readonly ?string $uf = null,
        public readonly ?string $email = null,
        public readonly ?string $dddTelefone = null,
        public readonly ?string $telefone = null,
        public readonly ?string $cpfRepresentanteEmpresa = null,
    ) {
        $this->tipoDocumento($tipoDocumento);
    }

    public function tipoDocumento(TipoDocumento|int $value): self
    {
        $this->tipoDocumento = TipoDocumento::tryFromEnhanced($value);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'tipoDocumento' => $this->tipoDocumento->value,
            'numeroDocumento' => $this->numeroDocumento,
            'cep' => $this->cep,
            'endereco' => $this->endereco,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'email' => $this->email,
            'dddTelefone' => $this->dddTelefone,
            'telefone' => $this->telefone,
            'cpfRepresentanteEmpresa' => $this->cpfRepresentanteEmpresa,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
