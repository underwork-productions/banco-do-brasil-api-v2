<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;

class IsRequiredDocumentoDevedor implements StageInterface
{
    private function isDebtorDocumentMissing($payload): bool
    {
        return v::attribute('devedorDocumento', v::nullType())
            ->attribute('devedorNome', v::not(v::nullType()))
            ->validate($payload);
    }

    private function isDebtorNameMissing($payload): bool
    {
        return v::attribute('devedorDocumento', v::not(v::nullType()))
            ->attribute('devedorNome', v::nullType())
            ->validate($payload);
    }

    public function __invoke($payload)
    {
        $var = new \stdClass;
        $var->devedorNome = $payload->devedorNome;
        $var->devedorDocumento = $payload->devedorDocumento;

        if ($this->isDebtorDocumentMissing($var)) {
            throw new \InvalidArgumentException('Documento do devedor é obrigatório quando nome do devedor é informado.');
        }

        if ($this->isDebtorNameMissing($var)) {
            throw new \InvalidArgumentException('Nome do devedor é obrigatório quando documento do devedor é informado.');
        }

        return $payload;
    }
}
