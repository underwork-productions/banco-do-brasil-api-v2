<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\BBPay;

use UnderWork\BancoDoBrasilApiV2\Api\BBApi;
use UnderWork\BancoDoBrasilApiV2\Builders\BBRequestBuilder;
use UnderWork\BancoDoBrasilApiV2\Concerns\BBPay\HasBBPayBaseUrl;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\BBPay\Solicitacao\CriarSolicitacao;

class BBApiBBPay extends BBApi
{
    use HasBBPayBaseUrl;

    public function criarSolicitacao(CriarSolicitacao $payload): mixed
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('POST')
                ->uri('/solicitacoes')
                ->body($payload->jsonSerialize())
                ->build()
        );
    }
}
