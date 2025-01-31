<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;

class IsValidSolicitacaoPagador implements StageInterface
{
    public function __invoke($payload)
    {
        if (! v::nullable(v::stringType()->max(140))->validate($payload->solicitacaoPagador)) {
            throw new \InvalidArgumentException('Solicitação ao pagador deve estar entre 0 e 140 caracteres.');
        }

        return $payload;
    }
}
