<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;

class IsValidExpiracao implements StageInterface
{
    public function __invoke($payload)
    {
        if (! v::intVal()->between(0, 2147483647)->validate($payload->expiracao)) {
            throw new \InvalidArgumentException('Expiração deve ser um valor entre 0 e 2147483647.');
        }

        return $payload;
    }
}
