<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;
use UnderWork\BancoDoBrasilApiV2\Enums\Pix\TipoRetirada;

class IsValidRetirada implements StageInterface
{
    public function __invoke($payload)
    {
        // Not null
        if ($payload->tipoRetirada->value) {
            if (! v::nullable(v::equals(0))->validate($payload->valor)) {
                throw new \InvalidArgumentException('Valor não deve ser informado ou deve ser igual a zero quando retirada for informada.');
            }

            if (! v::nullable(v::equals(0))->validate($payload->modalidadeAlteracao->value)) {
                throw new \InvalidArgumentException('Modalidade de alteração não deve ser informada ou deve ser igual a zero quando retirada for informada.');
            }

            if (! v::decimal(2)->min(0)->validate((string) $payload->retiradaValor)) {
                throw new \InvalidArgumentException('Valor de retirada deve ser um número com duas casas decimais e maior ou igual a zero.');
            }

            if ($payload->tipoRetirada === TipoRetirada::Saque) {
            }
        }

        return $payload;
    }
}
