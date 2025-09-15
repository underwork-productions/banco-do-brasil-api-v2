<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao\Objects;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBSerialize;
use UnderWork\BancoDoBrasilApiV2\Enums\BBPay\Repasse\TipoValorRepasse;
use UnderWork\BancoDoBrasilApiV2\Traits\HasBuilder;

/**
 * @mixin IdeHelperRepasseBuilder
 *
 * @since 0.0.3
 */
class Repasse implements BBSerialize
{
    use HasBuilder;

    public readonly TipoValorRepasse $tipoValorRepasse;

    /**
     * @param  TipoValorRepasse|string  $tipoValorRepasse
     * @param  array<Recebedor>  $recebedores
     * @return void
     */
    public function __construct(
        $tipoValorRepasse,
        public readonly array $recebedores,
    ) {
        $this->tipoValorRepasse($tipoValorRepasse);
    }

    public function tipoValorRepasse(TipoValorRepasse|string $value): self
    {
        $this->tipoValorRepasse = TipoValorRepasse::tryFromEnhanced($value);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'tipoValorRepasse' => $this->tipoValorRepasse,
            'recebedores' => $this->recebedores,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
