<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;

class IsValidValor implements StageInterface
{
    public function __invoke($payload)
    {
        /**
         * It will force the value to be a string instead
         * of a float because the library cannot enforce
         * decimals on a float
         */
        if (! v::decimal(2)->min(0)->validate((string) $payload->valor)) {
            throw new \InvalidArgumentException('Valor deve ser um número com duas casas decimais e maior ou igual a zero.');
        }

        return $payload;
    }
}
