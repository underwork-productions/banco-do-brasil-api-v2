<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;

class IsValidInfoAdicionais implements StageInterface
{
    public function __invoke($payload)
    {
        if ($payload->infoAdicionais) {
            if (! v::arrayType()->length(0, 50)->validate($payload->infoAdicionais)) {
                throw new \InvalidArgumentException('Informações adicionais deve ser um array com no máximo 50 itens.');
            }

            if (! v::each(v::key('nome')->key('valor'))->validate($payload->infoAdicionais)) {
                throw new \InvalidArgumentException('Todos os items em informações adicionais devem conter as chaves nome e valor.');
            }
        }

        return $payload;
    }
}
