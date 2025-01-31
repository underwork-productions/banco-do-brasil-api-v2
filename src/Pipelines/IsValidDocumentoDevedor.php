<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Pipelines;

use League\Pipeline\StageInterface;
use Respect\Validation\Validator as v;
use UnderWork\BancoDoBrasilApiV2\Enums\TipoDocumento;

class IsValidDocumentoDevedor implements StageInterface
{
    private function getDocumentType(mixed $documentType): ?string
    {
        if (! is_null($documentType)) {
            if ($documentType instanceof TipoDocumento) {
                return $documentType->value;
            }

            if ($enum = TipoDocumento::tryFromEnhanced($documentType)) {
                return $enum->value;
            }

            throw new \InvalidArgumentException('Invalid document type.');
        }

        return null;
    }

    private function isDocumentRequired($payload): bool
    {
        return v::attribute('devedorTipoDocumento', v::nullType())
            ->attribute('devedorDocumento', v::notEmpty())
            ->validate($payload);
    }

    private function isValidCpf($payload): bool
    {
        return v::attribute('devedorTipoDocumento', v::equals('cpf'))
            ->attribute('devedorDocumento', v::cpf())
            ->validate($payload);
    }

    private function isValidCnpj($payload): bool
    {
        return v::attribute('devedorTipoDocumento', v::equals('cnpj'))
            ->attribute('devedorDocumento', v::cnpj())
            ->validate($payload);
    }

    public function __invoke($payload)
    {
        $var = new \stdClass;
        $var->devedorTipoDocumento = $this->getDocumentType($payload->devedorTipoDocumento);
        $var->devedorDocumento = $payload->devedorDocumento;

        if ($this->isDocumentRequired($var)) {
            throw new \InvalidArgumentException('Ao informar um documento é necessário informar o seu tipo.');
        }

        if ($var->devedorTipoDocumento === TipoDocumento::Cpf->value && ! $this->isValidCpf($var)) {
            throw new \InvalidArgumentException('Documento do devedor tem que ser um CPF válido.');
        }

        if ($var->devedorTipoDocumento === TipoDocumento::Cnpj->value && ! $this->isValidCnpj($var)) {
            throw new \InvalidArgumentException('Documento do devedor tem que ser um CPF válido.');
        }

        return $payload;
    }
}
