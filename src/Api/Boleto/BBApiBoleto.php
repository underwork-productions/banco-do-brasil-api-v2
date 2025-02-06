<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\Boleto;

use UnderWork\BancoDoBrasilApiV2\Api\BBApi;
use UnderWork\BancoDoBrasilApiV2\Builders\BBRequestBuilder;
use UnderWork\BancoDoBrasilApiV2\Concerns\Boleto;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\Boleto\Cobranca;

class BBApiBoleto extends BBApi
{
    use Boleto\HasBoletoBaseUrl;

    public function criarCobranca(Cobranca $payload = new Cobranca)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('POST')
                ->uri('/boletos')
                ->body($payload->jsonSerialize())
                ->build()
        );
    }
}
