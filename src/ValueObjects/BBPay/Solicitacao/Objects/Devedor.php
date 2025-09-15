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
        public readonly int $numeroDocumento,
        public readonly int $cep,
        public readonly string $endereco,
        public readonly string $bairro,
        public readonly string $cidade,
        public readonly string $uf,
        public readonly string $email,
        public readonly int $dddTelefone,
        public readonly int $telefone,
        public readonly ?int $cpfRepresentanteEmpresa,
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
