<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;

class IsValidNomeDevedor implements StageInterface
{
    public function __invoke($payload)
    {
        if (! v::nullable(v::stringType()->length(min: 1, max: 200))->validate($payload->devedorNome)) {
            throw new \InvalidArgumentException('Nome do devedor deve estar entre 1 e 200 caracteres.');
        }

        return $payload;
    }
}
