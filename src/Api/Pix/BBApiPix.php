<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\Pix;

use UnderWork\BancoDoBrasilApiV2\Api\BBApi;
use UnderWork\BancoDoBrasilApiV2\Builders\BBRequestBuilder;
use UnderWork\BancoDoBrasilApiV2\Concerns\Pix;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\Pix\CobrancaImediata;

class BBApiPix extends BBApi
{
    use Pix\HasPixBaseUrl;

    public function criarCobrancaImediata(string $txId, CobrancaImediata $payload)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PUT')
                ->uri("/cob/{$txId}")
                ->body($payload->jsonSerialize())
                ->build()
        );
    }
}
