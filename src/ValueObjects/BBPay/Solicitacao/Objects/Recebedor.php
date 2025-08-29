<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\BBPay\Solicitacao\Objects;

use TipoRecebedor;
use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;

/**
 * @mixin IdeHelperRecebedorBuilder
 *
 * @since 0.0.3
 */
class Recebedor implements BBSerialize
{
    use HasBuilder;

    public readonly TipoRecebedor $tipoRecebedor;

    /**
     * @param  TipoRecebedor|string  $tipoRecebedor
     */
    public function __construct(
        public readonly int $identificadorRecebedor,
        public readonly float $valorRepasse,
        $tipoRecebedor,
    ) {
        $this->tipoRecebedor($tipoRecebedor);
    }

    public function tipoRecebedor(TipoRecebedor|string $value): self
    {
        $this->tipoRecebedor = TipoRecebedor::tryFromEnhanced($value);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'identificadorRecebedor' => $this->identificadorRecebedor,
            'valorRepasse' => $this->valorRepasse,
            'tipoRecebedor' => $this->tipoRecebedor->value,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
